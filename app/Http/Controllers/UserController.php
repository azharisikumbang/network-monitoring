<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Response\IndexViewDataResponse;
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
            ->paginate($request->get('limit') ?? 10, ['name', 'email', 'id']);

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
        return Inertia::render('users/Create');
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
            'email' => $user->email
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
        //
    }
}
