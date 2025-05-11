<?php

namespace App\Http\Controllers;

use App\Http\Response\IndexViewDataResponse;
use App\Models\User;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
