<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Http\Response\IndexViewDataResponse;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = Branch::when($request->get('search'), function (Builder $model) use ($request) {
            $search = "%" . $request->get('search') . "%";

            return $model->whereLike('name', $search);
        })
            ->with('manager')
            ->orderBy('name')
            ->paginate($request->get('limit') ?? 10)
            ->withQueryString();

        return Inertia::render(
            'branches/Index',
            new IndexViewDataResponse($users, $request)->toArray()
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $managers = User::manager()->get(['id', 'name', 'contact']);

        return Inertia::render('branches/Create', [
            'managers' => $managers->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBranchRequest $request)
    {
        $branch = Branch::create($request->validated());

        return to_route('branches.index')
            ->with('success', "Branch '{$branch->name}' created succeesfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        return Inertia::render("branches/Edit", $branch->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        $branch->update($request->validated());
        $branch->refresh();

        return to_route('branches.index')
            ->with('success', "User '{$branch->name}' updated succeesfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();

        return to_route('branches.index')
            ->with('success', "Branch '{$branch->name}' deleted succesfully.");
    }
}
