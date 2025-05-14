<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::orderBy('name')->get();

        return Inertia::render('roles/Index', ['roles' => $roles->toArray()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', Rule::unique(Role::class)->ignore($request->get('id'))],
            'as' => ['nullable'],
            'id' => ['nullable']
        ]);

        $validated['name'] = strtoupper(str_replace(' ', '_', $validated['name']));

        if (null == $validated['as'])
            $validated['as'] = ucwords(str_replace("_", " ", $validated['name']));

        $role = Role::updateOrCreate(['id' => $validated['id']], [
            'name' => $validated['name'],
            'as' => $validated['as']
        ]);

        return to_route('roles.index')
            ->with('success', "User '{$role->as}' created succeesfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if ($role->isCannotDeleted())
            return to_route('roles.index')
                ->with('error', "You cannot delete role '{$role->name}'. It's default.");

        $role->delete();

        return to_route('roles.index')
            ->with('success', "Branch '{$role->name}' deleted succesfully.");
    }
}
