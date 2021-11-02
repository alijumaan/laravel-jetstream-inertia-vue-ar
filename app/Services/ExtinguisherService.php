<?php

namespace App\Services;

use App\Models\Building;
use App\Models\Extinguisher;
use Illuminate\Support\Facades\Cache;

class ExtinguisherService
{
    public function getExtinguishersFromSession()
    {
        $extinguishers = Cache::get('extinguishers');
        if (!$extinguishers) {
            $extinguishers = Extinguisher::orderBy('type')->get();
            Cache::forever('extinguishers', $extinguishers);
        }

        return $extinguishers;
    }

    public function getBuildingsFromSession()
    {
        $buildings = Cache::get('buildings');
        if (!$buildings) {
            $buildings = Building::select('id', 'name')->get();
            Cache::forever('buildings', $buildings);
        }

        return $buildings;
    }

    public function getExtinguisherFromSession(string $slug)
    {
        $key = "show_extinguisher_{$slug}";
        $extinguisher = Cache::get($key);

        if (!$extinguisher) {
            $extinguisher = Extinguisher::whereSlug($slug)->firstOrFail();
            Cache::forever($key, $extinguisher);
        }

        return $extinguisher;
    }
}
