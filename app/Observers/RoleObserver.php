<?php

namespace App\Observers;

use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;

class RoleObserver
{
    /**
     * Handle the Role "created" event.
     *
     * @param \Spatie\Permission\Models\Role  $role
     * @return void
     */
    public function created(Role $role)
    {
        Artisan::call('cache:clear');
    }

    /**
     * Handle the User "updated" event.
     *
     * @param \Spatie\Permission\Models\Role  $role
     * @return void
     */
    public function updated(Role $role)
    {
        Artisan::call('cache:clear');
    }

    /**
     * Handle the Role "deleted" event.
     *
     * @param \Spatie\Permission\Models\Role  $role
     * @return void
     */
    public function deleted(Role $role)
    {
        Artisan::call('cache:clear');
    }

    /**
     * Handle the Building "restored" event.
     *
     * @param \Spatie\Permission\Models\Role  $role
     * @return void
     */
    public function restored(Role $building)
    {
        //
    }

    /**
     * Handle the Building "force deleted" event.
     *
     * @param \Spatie\Permission\Models\Role  $role
     * @return void
     */
    public function forceDeleted(Role $building)
    {
        //
    }
}
