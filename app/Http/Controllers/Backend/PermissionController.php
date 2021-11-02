<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PermissionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('access_permission');

        $pagination = 10;
        $page = 1;

        if ($request->has('page')) {
            $page = $request->input('page');
        }

        $key = "permission_page_{$page}";
        $permissions = Cache::get($key);
        if (!$permissions) {
            $permissions = Permission::select(['id', 'name'])
                ->orderBy('name')
                ->paginate($pagination);
            Cache::forever($key, $permissions);
        }

        return Inertia::render('Permissions/Index', [
            'permissions' => $permissions,
            'pagination' => $pagination
        ]);
    }

    public function create()
    {
        $this->authorize('create_permission');

        return Inertia::render('Permissions/Create');
    }

    public function store(PermissionRequest $request)
    {
        $this->authorize('create_permission');

        Permission::create($request->validated());

        return Redirect::route('permissions.index');
    }

    public function edit(Permission $permission): Response
    {
        $this->authorize('edit_permission');

        return Inertia::render('Permissions/Edit', [
            'permission' => $permission
        ]);
    }

    public function update(Permission $permission, PermissionRequest $request)
    {
        $this->authorize('edit_permission');

        $permission->update($request->validated());

        return Redirect::route('permissions.index');
    }

    public function destroy(Permission $permission)
    {
        $this->authorize('delete_permission');

        $permission->delete();

        return Redirect::route('permissions.index');
    }
}
