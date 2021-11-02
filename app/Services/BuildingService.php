<?php

namespace App\Services;

use App\Models\Building;
use App\Models\Period;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class BuildingService
{
    public function calculateValidPeriodBuilding($periodId): ?Carbon
    {
        if ($periodId == Building::ONE_MONTH) {
            return Carbon::now()->addMonth();
        } elseif ($periodId == Building::THREE_MONTHS) {
            return Carbon::now()->addDays('90');
        } elseif ($periodId == Building::SIX_MONTHS) {
            return Carbon::now()->addDays('180');
        } elseif ($periodId == Building::YEAR) {
            return Carbon::now()->addYear();
        } else {
            return null;
        }
    }

    public function getPeriodsFromSession()
    {
        $key = "periods";
        $periods = Cache::get($key);

        if (!$periods) {
            $periods = Period::select('id', 'period')->get();
            Cache::forever($key, $periods);
        }

        return $periods;
    }

    public function getUsersFromSession()
    {
        $key = "users";
        $users = Cache::get($key);

        if (!$users) {
            $users = User::select('id', 'name')->get();
            Cache::forever($key, $users);
        }

        return $users;
    }

    public function getBuildingFromSession(string $slug)
    {
        $key = "show_building_{$slug}";
        $building = Cache::get($key);

        if (!$building) {
            $building = Building::whereSlug($slug)->firstOrFail();
            Cache::forever($key, $building);
        }

        return $building;
    }
}
