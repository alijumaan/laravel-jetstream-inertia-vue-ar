<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\RolePermissionResoucre;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function getRoles()
    {
        $key = "roles";
        $roles = Cache::get($key);

        if (!$roles) {
            $roles = Role::with('permissions')->get();
            Cache::forever($key, $roles);
        }

        return Inertia::render('RolePermissions/Index', [
            'roles' => RolePermissionResoucre::collection($roles)
        ]);
    }

    public function getPermissions($roleId)
    {
        $key = "role_permissions_{$roleId}";
        $rolePermissions = Cache::get($key);

        if (!$rolePermissions) {
            $rolePermissions = Role::with('permissions')->where('id', $roleId)->get();
            Cache::forever($key, $rolePermissions);
        }

        return response()->json([
            'rolePermissions' => $rolePermissions
        ]);
    }

}
