<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\RoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('access_role');

        $pagination = 10;
        $page = 1;

        if ($request->has('page')) {
            $page = $request->input('page');
        }

        $key = "role_page_{$page}";
        $roles = Cache::get($key);
        if (!$roles) {
            $roles = Role::with('permissions')->select(['id', 'name'])
                ->orderBy('name')
                ->paginate($pagination);
            Cache::forever($key, $roles);
        }

        $key = "permissions";
        $permissions = Cache::get($key);

        if (!$permissions) {
            $permissions = Permission::all();
            Cache::forever($key, $permissions);
        }

        return Inertia::render('Roles/Index', [
            'roles' => $roles,
            'permissions' => $permissions,
            'pagination' => $pagination
        ]);
    }

    public function store(RoleRequest $request)
    {
        $this->authorize('create_role');

        $role = Role::create($request->validated() + [
            'guard_name' => 'web'
        ]);

        if ($request->has('permissions')) {
            $role->syncPermissions(collect($request->permissions)->pluck('id')->toArray());
        }

        return Redirect::route('roles.index');
    }

    public function update(RoleRequest $request, Role $role)
    {
        $this->authorize('edit_role');

        $role->update($request->validated());

        if ($request->has('permissions')) {
            $role->syncPermissions(collect($request->permissions)->pluck('id')->toArray());
        }

        Artisan::call('cache:clear');

        return Redirect::route('roles.index');
    }

    public function destroy(Role $role)
    {
        $this->authorize('delete_role');

        $role->delete();

        return Redirect::route('roles.index');
    }
}
