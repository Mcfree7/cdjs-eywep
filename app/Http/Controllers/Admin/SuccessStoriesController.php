<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuccessStory;
use App\Models\SuccessStoryImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SuccessStoriesController extends Controller
{
    public function index()
    {
        $search = request('search');
        $publicationDate = request('datePublication');
        $sort = request('sort', 'id');
        $direction = request('direction', 'desc');

        $allowedSorts = ['id', 'titre', 'datePublication'];
        $allowedDirections = ['asc', 'desc'];

        if (!in_array($sort, $allowedSorts, true)) {
            $sort = 'id';
        }

        if (!in_array($direction, $allowedDirections, true)) {
            $direction = 'desc';
        }

        $successStoriesQuery = SuccessStory::with(['images', 'coverImage']);

        if ($search) {
            $successStoriesQuery->where(function ($query) use ($search) {
                $query->where('titre', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($publicationDate) {
            $successStoriesQuery->whereDate('datePublication', $publicationDate);
        }

        $successStoriesQuery->orderBy($sort, $direction);

        if ($sort !== 'id') {
            $successStoriesQuery->orderByDesc('id');
        }

        $successStories = $successStoriesQuery
            ->paginate(7)
            ->withQueryString();

        return view('admin.pages.success-stories.AllSuccessStories', compact('successStories'));
    }

    public function create()
    {
        return view('admin.pages.success-stories.CreateSuccessStory', [
            'defaultPublicationDate' => now()->toDateString(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'datePublication' => ['nullable', 'date'],
            'images' => ['required', 'array', 'min:1'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        DB::transaction(function () use ($validated, $request) {
            $successStory = SuccessStory::create([
                'titre' => $validated['titre'],
                'description' => $validated['description'],
                'datePublication' => $validated['datePublication'] ?? Carbon::today()->toDateString(),
                'imageId' => null,
            ]);

            $coverImageId = null;

            foreach ($request->file('images', []) as $uploadedImage) {
                $path = $uploadedImage->store('success-stories', 'public');

                $image = SuccessStoryImage::create([
                    'success_story_id' => $successStory->id,
                    'image_path' => $path,
                ]);

                if ($coverImageId === null) {
                    $coverImageId = $image->id;
                }
            }

            if ($coverImageId !== null) {
                $successStory->update(['imageId' => $coverImageId]);
            }
        });

        return redirect()
            ->route('success-stories.index')
            ->with('success', 'Success story creee avec succes.');
    }

    public function show(SuccessStory $successStory)
    {
        $successStory->load(['images', 'coverImage']);

        return view('admin.pages.success-stories.ShowSuccessStory', compact('successStory'));
    }

    public function edit(SuccessStory $successStory)
    {
        $successStory->load(['images', 'coverImage']);

        return view('admin.pages.success-stories.EditSuccessStory', [
            'successStory' => $successStory,
            'defaultPublicationDate' => optional($successStory->datePublication)->format('Y-m-d') ?? now()->toDateString(),
        ]);
    }

    public function update(Request $request, SuccessStory $successStory)
    {
        $validated = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'datePublication' => ['nullable', 'date'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'remove_images' => ['nullable', 'array'],
            'remove_images.*' => ['integer'],
            'cover_image_id' => ['nullable', 'integer'],
        ]);

        $successStory->load('images');

        DB::transaction(function () use ($successStory, $request, $validated) {
            $successStory->update([
                'titre' => $validated['titre'],
                'description' => $validated['description'],
                'datePublication' => $validated['datePublication'] ?? Carbon::today()->toDateString(),
            ]);

            $removeImageIds = collect($validated['remove_images'] ?? [])
                ->map(fn ($id) => (int) $id)
                ->all();

            if (!empty($removeImageIds)) {
                $imagesToRemove = $successStory->images()->whereIn('id', $removeImageIds)->get();

                foreach ($imagesToRemove as $image) {
                    Storage::disk('public')->delete($image->image_path);
                    $image->delete();
                }
            }

            foreach ($request->file('images', []) as $uploadedImage) {
                $path = $uploadedImage->store('success-stories', 'public');

                SuccessStoryImage::create([
                    'success_story_id' => $successStory->id,
                    'image_path' => $path,
                ]);
            }

            $remainingImageIds = $successStory->images()->pluck('id')->all();
            $requestedCoverId = isset($validated['cover_image_id']) ? (int) $validated['cover_image_id'] : null;

            $coverImageId = in_array($requestedCoverId, $remainingImageIds, true)
                ? $requestedCoverId
                : ($remainingImageIds[0] ?? null);

            $successStory->update([
                'imageId' => $coverImageId,
            ]);
        });

        return redirect()
            ->route('success-stories.index')
            ->with('success', 'Success story modifiee avec succes.');
    }

    public function destroy(SuccessStory $successStory)
    {
        $successStory->load('images');

        DB::transaction(function () use ($successStory) {
            foreach ($successStory->images as $image) {
                Storage::disk('public')->delete($image->image_path);
            }

            $successStory->delete();
        });

        return redirect()
            ->route('success-stories.index')
            ->with('success', 'Success story supprimee avec succes.');
    }
}
