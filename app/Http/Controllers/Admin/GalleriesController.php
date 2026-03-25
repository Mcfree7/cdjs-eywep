<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GalleriesController extends Controller
{
    public function index()
    {
        $search = request('search');
        $direction = request('direction', 'desc');

        $galleriesQuery = Gallery::with('medias');

        if ($search) {
            $galleriesQuery->where('titre', 'like', '%' . $search . '%');
        }

        $galleries = $galleriesQuery
            ->orderBy('id', $direction === 'asc' ? 'asc' : 'desc')
            ->paginate(7)
            ->withQueryString();

        return view('admin.pages.gallery.AllGalleries', compact('galleries'));
    }

    public function create()
    {
        return view('admin.pages.gallery.CreateGallery');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'medias' => ['required', 'array', 'min:1'],
            'medias.*' => ['file', 'mimes:jpg,jpeg,png,webp,mp4,mov,avi,webm', 'max:20480'],
        ]);

        DB::transaction(function () use ($validated, $request) {
            $gallery = Gallery::create([
                'titre' => $validated['titre'],
            ]);

            foreach ($request->file('medias', []) as $uploadedMedia) {
                $path = $uploadedMedia->store('galleries', 'public');
                $mimeType = $uploadedMedia->getMimeType() ?? '';

                GalleryMedia::create([
                    'gallery_id' => $gallery->id,
                    'media_path' => $path,
                    'media_type' => str_starts_with($mimeType, 'video/') ? 'video' : 'image',
                ]);
            }
        });

        return redirect()
            ->route('galleries.index')
            ->with('success', 'Galerie creee avec succes.');
    }

    public function show(Gallery $gallery)
    {
        $gallery->load('medias');

        return view('admin.pages.gallery.ShowGallery', compact('gallery'));
    }

    public function edit(Gallery $gallery)
    {
        $gallery->load('medias');

        return view('admin.pages.gallery.EditGallery', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'medias' => ['nullable', 'array'],
            'medias.*' => ['file', 'mimes:jpg,jpeg,png,webp,mp4,mov,avi,webm', 'max:20480'],
            'remove_medias' => ['nullable', 'array'],
            'remove_medias.*' => ['integer'],
        ]);

        DB::transaction(function () use ($gallery, $request, $validated) {
            $gallery->update([
                'titre' => $validated['titre'],
            ]);

            $removeMediaIds = collect($validated['remove_medias'] ?? [])
                ->map(fn ($id) => (int) $id)
                ->all();

            if (!empty($removeMediaIds)) {
                $mediasToRemove = $gallery->medias()->whereIn('id', $removeMediaIds)->get();

                foreach ($mediasToRemove as $media) {
                    Storage::disk('public')->delete($media->media_path);
                    $media->delete();
                }
            }

            foreach ($request->file('medias', []) as $uploadedMedia) {
                $path = $uploadedMedia->store('galleries', 'public');
                $mimeType = $uploadedMedia->getMimeType() ?? '';

                GalleryMedia::create([
                    'gallery_id' => $gallery->id,
                    'media_path' => $path,
                    'media_type' => str_starts_with($mimeType, 'video/') ? 'video' : 'image',
                ]);
            }
        });

        return redirect()
            ->route('galleries.index')
            ->with('success', 'Galerie modifiee avec succes.');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->load('medias');

        DB::transaction(function () use ($gallery) {
            foreach ($gallery->medias as $media) {
                Storage::disk('public')->delete($media->media_path);
            }

            $gallery->delete();
        });

        return redirect()
            ->route('galleries.index')
            ->with('success', 'Galerie supprimee avec succes.');
    }
}
