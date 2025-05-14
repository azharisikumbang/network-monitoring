<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Response\IndexViewDataResponse;
use App\Models\Branch;
use App\Models\Role;
use App\Models\User;
use Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::when($request->get('search'), function (Builder $model) use ($request) {
            $search = "%" . $request->get('search') . "%";

            return $model
                ->whereLike('name', $search)
                ->orWhereLike('email', $search)
            ;
        })

            ->orderBy('name')
            ->with('technicianBranch')
            ->paginate($request->get('limit') ?? 10)
            ->withQueryString();

        return Inertia::render(
            'users/Index',
            new IndexViewDataResponse($users, $request)->toArray()
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('users/Create', [
            'roles' => Role::orderBy('name')->get()->toArray(),
            'branches' => Branch::active()
                ->orderBy('name')
                ->get(['id', 'name'])
                ->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'branch_id' => $request->branch_id,
            'contact' => $request->contact
        ]);

        return to_route('users.index')
            ->with('success', "User '{$user->name}' created succeesfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return Inertia::render("users/Edit", [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'contact' => $user->contact
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        $user->refresh();

        return to_route('users.index')
            ->with('success', "User '{$user->email}' updated succeesfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->isAdministrator())
            return to_route('users.index')
                ->with('error', "You cannot delete user with role '{$user->role->name}'.");

        $user->delete();

        return to_route('users.index')
            ->with('success', "User deleted succesfully.");
    }
}
