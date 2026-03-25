<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ActivitiesController extends Controller
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

        $activitiesQuery = Activity::with(['images', 'coverImage']);

        if ($search) {
            $activitiesQuery->where(function ($query) use ($search) {
                $query->where('titre', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($publicationDate) {
            $activitiesQuery->whereDate('datePublication', $publicationDate);
        }

        $activitiesQuery->orderBy($sort, $direction);

        if ($sort !== 'id') {
            $activitiesQuery->orderByDesc('id');
        }

        $activities = $activitiesQuery
            ->paginate(7)
            ->withQueryString();

        return view('admin.pages.activity.AllActivities', compact('activities'));
    }

    public function create()
    {
        return view('admin.pages.activity.CreateActivity', [
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
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        DB::transaction(function () use ($validated, $request) {
            $activity = Activity::create([
                'titre' => $validated['titre'],
                'description' => $validated['description'],
                'datePublication' => $validated['datePublication'] ?? Carbon::today()->toDateString(),
                'imageId' => null,
            ]);

            $coverImageId = null;

            foreach ($request->file('images', []) as $uploadedImage) {
                $path = $uploadedImage->store('activities', 'public');

                $image = ActivityImage::create([
                    'activity_id' => $activity->id,
                    'image_path' => $path,
                ]);

                if ($coverImageId === null) {
                    $coverImageId = $image->id;
                }
            }

            if ($coverImageId !== null) {
                $activity->update(['imageId' => $coverImageId]);
            }
        });

        return redirect()
            ->route('activities.index')
            ->with('success', 'Activite creee avec succes.');
    }

    public function show(Activity $activity)
    {
        $activity->load(['images', 'coverImage']);

        return view('admin.pages.activity.ShowActivity', compact('activity'));
    }

    public function edit(Activity $activity)
    {
        $activity->load(['images', 'coverImage']);

        return view('admin.pages.activity.EditActivity', [
            'activity' => $activity,
            'defaultPublicationDate' => optional($activity->datePublication)->format('Y-m-d') ?? now()->toDateString(),
        ]);
    }

    public function update(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'datePublication' => ['nullable', 'date'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'remove_images' => ['nullable', 'array'],
            'remove_images.*' => ['integer'],
            'cover_image_id' => ['nullable', 'integer'],
        ]);

        $activity->load('images');

        DB::transaction(function () use ($activity, $request, $validated) {
            $activity->update([
                'titre' => $validated['titre'],
                'description' => $validated['description'],
                'datePublication' => $validated['datePublication'] ?? Carbon::today()->toDateString(),
            ]);

            $removeImageIds = collect($validated['remove_images'] ?? [])
                ->map(fn ($id) => (int) $id)
                ->all();

            if (!empty($removeImageIds)) {
                $imagesToRemove = $activity->images()->whereIn('id', $removeImageIds)->get();

                foreach ($imagesToRemove as $image) {
                    Storage::disk('public')->delete($image->image_path);
                    $image->delete();
                }
            }

            foreach ($request->file('images', []) as $uploadedImage) {
                $path = $uploadedImage->store('activities', 'public');

                ActivityImage::create([
                    'activity_id' => $activity->id,
                    'image_path' => $path,
                ]);
            }

            $remainingImageIds = $activity->images()->pluck('id')->all();
            $requestedCoverId = isset($validated['cover_image_id']) ? (int) $validated['cover_image_id'] : null;

            $coverImageId = in_array($requestedCoverId, $remainingImageIds, true)
                ? $requestedCoverId
                : ($remainingImageIds[0] ?? null);

            $activity->update([
                'imageId' => $coverImageId,
            ]);
        });

        return redirect()
            ->route('activities.index')
            ->with('success', 'Activite modifiee avec succes.');
    }

    public function destroy(Activity $activity)
    {
        $activity->load('images');

        DB::transaction(function () use ($activity) {
            foreach ($activity->images as $image) {
                Storage::disk('public')->delete($image->image_path);
            }

            $activity->delete();
        });

        return redirect()
            ->route('activities.index')
            ->with('success', 'Activite supprimee avec succes.');
    }
}
