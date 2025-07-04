<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\CollectionItem;
use App\Http\Requests\CollectionItemStoreRequest;
use App\Http\Requests\CollectionItemUpdateRequest;
use App\Http\Requests\CollectionItemReorderRequest;

class CollectionItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CollectionItemStoreRequest $request, Collection $collection)
    {
        $this->authorize('update', $collection);

        $validated = $request->validated();

        $position = $collection->items()->max('position') + 1;

        $item = $collection->items()->create([
            ...$validated,
            'position' => $position,
        ]);

        return redirect()->route('collections.show', $collection)
            ->with('success', 'Item adicionado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Collection $collection, CollectionItem $item)
    {
        $this->authorize('update', $collection);
        return view('collections.items.edit', compact('collection', 'item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CollectionItemUpdateRequest $request, Collection $collection, CollectionItem $item)
    {
        $this->authorize('update', $collection);

        $validated = $request->validated();

        $item->update($validated);

        return redirect()->route('collections.show', $collection)
            ->with('success', 'Item atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Collection $collection, CollectionItem $item)
    {
        $this->authorize('update', $collection);

        $item->delete();

        return redirect()->route('collections.show', $collection)
            ->with('success', 'Item excluído com sucesso!');
    }

    public function reorder(CollectionItemReorderRequest $request, Collection $collection)
    {
        $this->authorize('update', $collection);

        $validated = $request->validated();

        foreach ($validated['items'] as $item) {
            CollectionItem::where('id', $item['id'])
                ->where('collection_id', $collection->id)
                ->update(['position' => $item['position']]);
        }

        return response()->json(['message' => 'Itens reordenados com sucesso!']);
    }
}
