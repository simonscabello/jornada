<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;

class CollectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collections = auth()->user()->collections()->withCount(['items', 'items as completed_items_count' => function ($query) {
            $query->where('done', true);
        }])->get();

        return view('collections.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('collections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
        ]);

        $collection = auth()->user()->collections()->create($validated);

        return redirect()->route('collections.show', $collection)
            ->with('success', 'Coleção criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Collection $collection)
    {
        $this->authorize('view', $collection);

        $items = $collection->items()->orderBy('position')->get();

        return view('collections.show', compact('collection', 'items'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Collection $collection)
    {
        $this->authorize('update', $collection);

        return view('collections.edit', compact('collection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Collection $collection)
    {
        $this->authorize('update', $collection);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
        ]);

        $collection->update($validated);

        return redirect()->route('collections.show', $collection)
            ->with('success', 'Coleção atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Collection $collection)
    {
        $this->authorize('delete', $collection);

        $collection->delete();

        return redirect()->route('collections.index')
            ->with('success', 'Coleção excluída com sucesso!');
    }
}
