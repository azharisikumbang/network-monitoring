<?php

namespace App\Http\Controllers;

use App\Actions\CreateNewSiteAction;
use App\Http\Requests\StoreSiteRequest;
use App\Http\Requests\UpdateSiteRequest;
use App\Http\Response\IndexViewDataResponse;
use App\Models\Branch;
use App\Models\Site;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $items = Site::when($request->get('search'), function (Builder $model) use ($request) {
            $search = "%" . $request->get('search') . "%";

            return $model
                ->whereLike('name', $search)
                ->orWhereLike('terminal_id', $search);
        })
            ->when($request->get('filter'), function (Builder $model) use ($request) {
                return match ($request->get('filter'))
                {
                    'deactivated' => $model->onlyTrashed(),
                    'all' => $model->withTrashed(),
                    default => $model
                };
            })
            ->orderBy('name')
            ->paginate($request->get('limit') ?? 10)
            ->withQueryString();

        return Inertia::render(
            'sites/Index',
            new IndexViewDataResponse($items, $request)->toArray()
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('sites/Create', [
            'branches' => Branch::orderBy('name')->get()->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSiteRequest $request)
    {
        $site = (new CreateNewSiteAction())->execute($request);

        return to_route('sites.show', $site->id)
            ->with('success', "Site {$site->name} create successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Site $site)
    {
        $site->load(['branch.manager', 'branch.technicians', 'audits.user']);

        return Inertia::render('sites/Show', [
            'site' => $site->toArray()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Site $site)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSiteRequest $request, Site $site)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Site $site)
    {
        $site->delete();

        return to_route('sites.index')
            ->with('success', "Site status for {$site->name} was deactivated.");
    }
}
