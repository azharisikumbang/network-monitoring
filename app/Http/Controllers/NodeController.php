<?php

namespace App\Http\Controllers;

use App\Actions\CreateNewNodeAction;
use App\Http\Requests\StoreNodeRequest;
use App\Http\Requests\UpdateNodeRequest;
use App\Http\Response\IndexViewDataResponse;
use App\Models\Node;
use App\Models\Site;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $items = Node::when($request->get('search'), function (Builder $model) use ($request) {
            $search = "%" . $request->get('search') . "%";

            return $model
                ->whereLike('name', $search)
                ->orWhereLike('ip_address', $search);
        })
            ->with('site')
            ->orderBy('name')
            ->paginate($request->get('limit') ?? 10)
            ->withQueryString();

        return Inertia::render(
            'nodes/Index',
            new IndexViewDataResponse($items, $request)->toArray()
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('nodes/Create', [
            'sites' => Site::orderBy('name')->pluck('name', 'id')->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNodeRequest $request)
    {
        (new CreateNewNodeAction())
            ->executeFromRequest($request);

        return to_route('nodes.index')
            ->with('success', 'Node added successfully, add new node or back to node lists.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Node $node)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Node $node)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNodeRequest $request, Node $node)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Node $node)
    {
        //
    }
}
