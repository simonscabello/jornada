<?php

namespace App\Http\Controllers;

use App\Models\LifeEvent;
use App\Services\FileUploaderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LifeEventController extends Controller
{
    public function __construct(private FileUploaderService $fileUploader)
    {}

    public function index()
    {
        $lifeEvents = auth()->user()->lifeEvents()->latest('event_date')->get();
        return view('life-events.index', compact('lifeEvents'));
    }

    public function create()
    {
        return view('life-events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'type' => 'required|string|max:50',
            'images.*' => 'nullable|image|max:5120',
        ]);

        $event = auth()->user()->lifeEvents()->create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $file = $this->fileUploader->uploadImage(
                    $image,
                    [
                        'fileable_type' => LifeEvent::class,
                        'fileable_id' => $event->id,
                    ]
                );
                $event->images()->save($file);
            }
        }

        return redirect()->route('life-events.show', $event)
            ->with('success', 'Evento criado com sucesso!');
    }

    public function show(LifeEvent $lifeEvent)
    {
        return view('life-events.show', compact('lifeEvent'));
    }

    public function edit(LifeEvent $lifeEvent)
    {
        return view('life-events.edit', compact('lifeEvent'));
    }

    public function update(Request $request, LifeEvent $lifeEvent)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'type' => 'required|string|max:50',
            'images.*' => 'nullable|image|max:5120',
            'remove_images' => 'nullable|array',
            'remove_images.*' => 'exists:files,id',
        ]);

        $lifeEvent->update($validated);

        if ($request->has('remove_images')) {
            foreach ($request->remove_images as $fileId) {
                $file = $lifeEvent->images()->find($fileId);
                if ($file) {
                    Storage::disk($file->disk)->delete($file->path);
                    $file->delete();
                }
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $file = $this->fileUploader->uploadImage(
                    $image,
                    [
                        'fileable_type' => LifeEvent::class,
                        'fileable_id' => $lifeEvent->id,
                    ]
                );
                $lifeEvent->images()->save($file);
            }
        }

        return redirect()->route('life-events.show', $lifeEvent)
            ->with('success', 'Evento atualizado com sucesso!');
    }

    public function destroy(LifeEvent $lifeEvent)
    {
        foreach ($lifeEvent->images as $image) {
            Storage::disk($image->disk)->delete($image->path);
        }

        $lifeEvent->delete();

        return redirect()->route('life-events.index')
            ->with('success', 'Evento excluído com sucesso!');
    }
}
