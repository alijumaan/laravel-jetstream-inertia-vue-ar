<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\UserRequest;
use App\Jobs\SendMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('Access user');

        $request->validate([
            'page' => ['numeric', 'min:1', 'max:1000']
        ]);

        $pagination = 10;
        $page = 1;

        if ($request->has('page')) {
            $page = $request->input('page');
        }

        $key = "user_page_{$page}";
        $users = Cache::get($key);

        if (!$users) {
            $users = User::select(['id', 'name', 'username', 'email', 'created_at', 'deleted_at'])
                ->whereNotIn('username', ['admin'])
                ->orderBy('name')
                ->latest()
                ->paginate($pagination);
            Cache::forever($key, $users);
        }

        $key1 = "inactive_user_page_{$page}";
        $inactiveUser = Cache::get($key1);

        if (!$inactiveUser) {
            $inactiveUser = User::onlyTrashed()->paginate($pagination);
            Cache::forever($key1, $inactiveUser);
        }

        return Inertia::render('Users/Index', [
            'users' => $users,
            'inactiveUsers' => $inactiveUser,
            'pagination' => $pagination
        ]);
    }

    public function create()
    {
        $this->authorize('Create user');

        $roles = Role::select('id', 'name')->whereNotIn('name', ['admin'])->get();

        return Inertia::render('Users/Create', [
            'roles' => $roles
        ]);
    }

    public function store(UserRequest $request)
    {
        $this->authorize('Create user');

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        $url = URL::signedRoute('invitation', $user);

        dispatch(new SendMail($user, $url));

        return Redirect::route('users.index')
            ->with('success', __('messages.save_successfully'));
    }

    public function edit(User $user): Response
    {
        $this->authorize('Edit user');

        $roles = Role::select('id', 'name')->whereNotIn('name', ['admin'])->get();

        return Inertia::render('Users/Edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(UserRequest $request, User $user)
    {
        $this->authorize('Edit user');

        $user->update($request->validated());

        if ($user->role && $user->role !== $request->role) {
            $user->removeRole($user->role);
        }
        $user->assignRole($request->role);

        if ($request->input('password')) {
            $user->update(['password' => bcrypt($request->password)]);
        }

        return Redirect::route('users.index')
            ->with('success', __('messages.update_successfully'));
    }

    public function destroy(User $user)
    {
        $this->authorize('Delete user');

        $user->delete();

        session()->flash('success', __('messages.delete_successfully'));
    }

    public function restore($userId)
    {
        $this->authorize('restore_user');

        $user = User::withTrashed()->findOrFail($userId);
        $user->restore();

        session()->flash('success', __('messages.restore_successfully'));
    }

    public function forceDelete($userId)
    {
        $this->authorize('force_delete_user');

        $user = User::withTrashed()->findOrFail($userId);
        $user->forceDelete();

        session()->flash('success', __('messages.permanently_delete_successfully'));
    }

    public function invitation(User $user)
    {
        if (!request()->hasValidSignature()) {
            abort(401);
        }

        return Redirect::route('login');
    }
}
