<?php

namespace App\Observers;

use App\Models\Extinguisher;
use Illuminate\Support\Facades\Artisan;

class ExtinguisherObserver
{
    /**
     * Handle the Extinguisher "created" event.
     *
     * @param  \App\Models\Extinguisher  $extinguisher
     * @return void
     */
    public function created(Extinguisher $extinguisher)
    {
        Artisan::call('cache:clear');
    }

    /**
     * Handle the Extinguisher "updated" event.
     *
     * @param  \App\Models\Extinguisher  $extinguisher
     * @return void
     */
    public function updated(Extinguisher $extinguisher)
    {
        Artisan::call('cache:clear');
    }

    /**
     * Handle the Extinguisher "deleted" event.
     *
     * @param  \App\Models\Extinguisher  $extinguisher
     * @return void
     */
    public function deleted(Extinguisher $extinguisher)
    {
        Artisan::call('cache:clear');
    }
}
