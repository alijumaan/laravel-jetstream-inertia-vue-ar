<?php

namespace App\Observers;

use App\Models\Building;
use Illuminate\Support\Facades\Artisan;

class BuildingObserver
{
    /**
     * Handle the Building "created" event.
     *
     * @param  \App\Models\Building  $building
     * @return void
     */
    public function created(Building $building)
    {
//        Cache::forget('buildings');
        Artisan::call('cache:clear');
    }

    /**
     * Handle the Building "updated" event.
     *
     * @param  \App\Models\Building  $building
     * @return void
     */
    public function updated(Building $building)
    {
        Artisan::call('cache:clear');
    }

    /**
     * Handle the Building "deleted" event.
     *
     * @param  \App\Models\Building  $building
     * @return void
     */
    public function deleted(Building $building)
    {
        Artisan::call('cache:clear');
    }

    /**
     * Handle the Building "restored" event.
     *
     * @param  \App\Models\Building  $building
     * @return void
     */
    public function restored(Building $building)
    {
        //
    }

    /**
     * Handle the Building "force deleted" event.
     *
     * @param  \App\Models\Building  $building
     * @return void
     */
    public function forceDeleted(Building $building)
    {
        //
    }
}
