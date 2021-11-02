<?php

use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\RolePermissionController;
use App\Http\Controllers\Frontend\BuildingController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\ExtinguisherController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ItemController;
use App\Http\Controllers\Frontend\PreventativeController;
use App\Http\Controllers\Frontend\SupplyController;
use App\Http\Controllers\Frontend\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    Route::group(['prefix' => '/supplies'], function() {
        Route::get('/', SupplyController::class)->name('supplies.index');
        # items
        Route::get('items/print', [ItemController::class, 'print'])->name('items.print');
        Route::resource('items', ItemController::class)->except('show');
    });

    Route::group(['prefix' => '/preventatives'], function() {
        Route::get('/', PreventativeController::class)->name('preventatives.index');
        # buildings
        Route::put('/buildings/update-status/{building}',
            [BuildingController::class, 'updateStatus'])->name('buildings.update_status');
        Route::resource('buildings', BuildingController::class)->except('create', 'edit');

        # extinguishers
        Route::delete('extinguishers/{extinguisherId}/{buildingId}',
            [ExtinguisherController::class, 'returnExtinguisherToBuilding'])->name('extinguishers.return');
        Route::resource('extinguishers', ExtinguisherController::class)->except('create', 'edit');
    });

    # permissions
    Route::resource('permissions', PermissionController::class)->except('show');

    # roles
    Route::resource('roles', RoleController::class)->except('show', 'edit', 'create');

    # role_permissions
    Route::get('role_permissions/{roleId}', [RolePermissionController::class, 'getPermissions'])->name('role_permissions.permissions');
    Route::get('role_permissions',[RolePermissionController::class, 'getRoles'])->name('role_permissions.roles');

    # users
    Route::get('users/invitation/{user}', [UserController::class, 'invitation'])->name('invitation');
    Route::post('/users/{userId}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('/users/{userId}/force-delete', [UserController::class, 'forceDelete'])->name('users.force_delete');
    Route::resource('users', UserController::class);

    Route::resource('contacts', ContactController::class);
});
