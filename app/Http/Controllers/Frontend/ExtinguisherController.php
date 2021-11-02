<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ExtinguisherRequest;
use App\Http\Resources\Frontend\ExtinguisherResource;
use App\Models\BuildingExtinguisher;
use App\Models\Extinguisher;
use App\Services\ExtinguisherService;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ExtinguisherController extends Controller
{
    public function index()
    {
        $this->authorize('Access extinguisher');

        $extinguishers = (new ExtinguisherService())->getExtinguishersFromSession();
        $buildings = (new ExtinguisherService())->getBuildingsFromSession();

        return Inertia::render('Preventative/Extinguishers/Index', [
            'extinguishers' => ExtinguisherResource::collection($extinguishers),
            'buildings' => $buildings
        ]);
    }

    public function show($slug)
    {
        $this->authorize('Show extinguisher');

        $extinguisher = (new ExtinguisherService())->getExtinguisherFromSession($slug);

        return Inertia::render('Preventative/Extinguishers/Show', [
            'extinguisher' => new ExtinguisherResource($extinguisher),
            'buildings' => $extinguisher->extinguisherBuildings,
        ]);
    }

    public function store(ExtinguisherRequest $request)
    {
        $this->authorize('Create extinguisher');

        BuildingExtinguisher::create($request->validated());

        return Redirect::route('extinguishers.index');
    }

    public function destroy(Extinguisher $extinguisher)
    {
        $this->authorize('Delete extinguisher');

        $extinguisher->delete();

        return Redirect::route('extinguishers.index');
    }

    public function returnExtinguisherToBuilding($extinguisherId, $buildingId)
    {
        $this->authorize('Delete extinguisher');

        BuildingExtinguisher::where('extinguisher_id', $extinguisherId)
            ->where('building_id', $buildingId)
            ->delete();

        return Redirect::route('extinguishers.index');
    }
}
