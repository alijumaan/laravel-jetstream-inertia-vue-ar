<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Extinguisher;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;

class PreventativeController extends Controller
{
    public function __invoke(): Response
    {
        $this->authorize('Access preventative');

        $userId = auth()->id();

        $keyBuildingCount = auth()->user()->hasRole('admin') || auth()->user()->hasRole('supervisor')
            ? "buildings_count_${userId}"
            : 'buildings_count';
        $buildings_count = Cache::get($keyBuildingCount);

        if (!$buildings_count) {
            if (auth()->user()->hasRole('admin')) {
                $buildings_count = Building::count();
            } elseif (auth()->user()->hasRole('supervisor')) {
                $buildings_count = Building::where('checked_at', '>', now())->count();
            } else {
                $buildings_count = Building::where('user_id', $userId)->count();
            }
            Cache::forever('buildings_count', $buildings_count);
        }

        $extinguishers_count = Cache::get('extinguishers_count');
        if (!$extinguishers_count) {
            $extinguishers_count = Extinguisher::count();
            Cache::forever('extinguishers_count', $extinguishers_count);
        }

        return Inertia::render('Preventative/Index', [
            'buildings_count' => $buildings_count,
            'extinguishers_count' => $extinguishers_count,
            'keyCount' => $keyBuildingCount
        ]);
    }
}
