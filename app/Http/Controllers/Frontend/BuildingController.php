<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\BuildingRequest;
use App\Models\Building;
use App\Services\BuildingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Redirect;

class BuildingController extends Controller
{
    public function index(Request $request): Response
    {
        $this->authorize('Access building');

        $request->validate([
            'page' => ['numeric', 'min:1', 'max:1000']
        ]);

        $buildingsLimit = 10;
        $page = 1;
        $userId = auth()->id();

        if ($request->has('page')) {
            $page = $request->input('page');
        }

        $key = "building_page_{$page}_{$userId}";
        $buildings = Cache::get($key);

        if (auth()->user()->hasRole('admin')) {
            $buildings = Building::select(['slug', 'name', 'number', 'checked_at', 'updated_at'])
                ->when($request->keyword, function ($query, $keyword) {
                    $query->where('name', 'LIKE', '%'.$keyword.'%');
                })
                ->orderBy('status')
                ->orderBy('checked_at')
                ->paginate($buildingsLimit);
        }

        if (auth()->user()->hasRole('supervisor')) {
            $buildings = Building::select(['slug', 'name', 'number', 'checked_at', 'updated_at'])
                ->where('checked_at', '>', now())
                ->when($request->keyword, function ($query, $keyword) {
                    $query->where('name', 'LIKE', '%'.$keyword.'%');
                })
                ->orderBy('status')
                ->orderBy('checked_at')
                ->paginate($buildingsLimit);
        }

        if (!$buildings) {
            $buildings = Building::select(['slug', 'name', 'number', 'checked_at', 'updated_at'])
                ->when($request->keyword, function ($query, $keyword) {
                    $query->where('name', 'LIKE', '%'.$keyword.'%');
                })
                ->where('user_id', $userId)
                ->orderBy('status')
                ->orderBy('checked_at')
                ->paginate($buildingsLimit);
            Cache::forever($key, $buildings);
        }

        return Inertia::render('Preventative/Buildings/Index', [
            'buildings' => $buildings,
            'buildingsLimit' => $buildingsLimit,
            'periods' => (new BuildingService())->getPeriodsFromSession(),
            'users' => (new BuildingService())->getUsersFromSession()
        ]);
    }

    public function show($slug): Response
    {
        $this->authorize('Show building');

        return Inertia::render('Preventative/Buildings/Show', [
            'building' => (new BuildingService())->getBuildingFromSession($slug),
            'periods' => (new BuildingService())->getPeriodsFromSession(),
            'users' => (new BuildingService())->getUsersFromSession()
        ]);
    }

    public function store(BuildingRequest $request)
    {
        $this->authorize('Create building');

        Building::create($request->validated() + [
           'user_id' => auth()->user()->getRoleNames()->contains('admin')
                        ? $request->user_id
                        : auth()->id()
        ]);

        return Redirect::route('buildings.index');
    }

    public function update(BuildingRequest $request, Building $building)
    {
        $this->authorize('Edit building');

        if ($request->status == 1) {
            $checked_at = (new BuildingService())->calculateValidPeriodBuilding($request->period_id);
        }

        $building->update($request->validated() + [
            'checked_at' => $checked_at ?? $building->checked_at,
            'user_id' => auth()->user()->getRoleNames()->contains('admin')
                    ? $request->user_id
                    : auth()->id()
        ]);

        return Redirect::route('buildings.index');
    }

    public function destroy(Building $building)
    {
        $this->authorize('Delete building');

        $building->delete();

        return Redirect::route('buildings.index');
    }

    public function updateStatus(Request $request, Building $building)
    {
        $this->authorize('Edit building');

        $building->update([
            'status' => 1,
            'checked_at' => (new BuildingService())->calculateValidPeriodBuilding($building->period_id)
        ]);

        return Redirect::route('buildings.index');
    }
}
