<?php

namespace App\Providers;

use App\Models\Building;
use App\Models\Extinguisher;
use App\Models\Item;
use App\Models\User;
use App\Observers\BuildingObserver;
use App\Observers\ExtinguisherObserver;
use App\Observers\ItemObserver;
use App\Observers\PermissionObserver;
use App\Observers\RoleObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        Inertia::share('app.name', config('app.name'));
//        Inertia::share('errors', function() {
//            return session()->get('errors') ? session()->get('errors')->getBag('default')->getMessages() : (object) [];
//        });
//        Inertia::share('success', function() {
//            return session()->get('success') ? session()->get('success') : null;
//        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Building::observe(BuildingObserver::class);
        Extinguisher::observe(ExtinguisherObserver::class);
        Item::observe(ItemObserver::class);
        User::observe(UserObserver::class);
        Permission::observe(PermissionObserver::class);
        Role::observe(RoleObserver::class);
    }
}
