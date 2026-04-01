<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProjectsController extends Controller
{
    public function index()
    {
        $search = request('search');
        $statut = request('statut');
        $sort = request('sort', 'id');
        $direction = request('direction', 'desc');

        $allowedSorts = ['id', 'titre', 'datePublication', 'statut'];
        $allowedDirections = ['asc', 'desc'];

        if (!in_array($sort, $allowedSorts, true)) {
            $sort = 'id';
        }

        if (!in_array($direction, $allowedDirections, true)) {
            $direction = 'desc';
        }

        $query = Project::withCount('candidatures')->with('coverImage');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('titre', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($statut) {
            $query->where('statut', $statut);
        }

        $query->orderBy($sort, $direction);

        if ($sort !== 'id') {
            $query->orderByDesc('id');
        }

        $projects = $query->paginate(7)->withQueryString();

        return view('admin.pages.projects.AllProjects', compact('projects'));
    }

    public function create()
    {
        return view('admin.pages.projects.CreateProject', [
            'defaultPublicationDate' => now()->toDateString(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre'           => ['required', 'string', 'max:255'],
            'description'     => ['required', 'string'],
            'datePublication' => ['nullable', 'date'],
            'date_cloture'    => ['nullable', 'date', 'after_or_equal:datePublication'],
            'statut'          => ['required', 'in:ouvert,ferme,archive'],
            'images'          => ['required', 'array', 'min:1'],
            'images.*'        => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'tdr'             => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:10240'],
        ]);

        DB::transaction(function () use ($validated, $request) {
            $tdrPath = null;
            if ($request->hasFile('tdr')) {
                $tdrPath = $request->file('tdr')->store('projects/tdr', 'public');
            }

            $project = Project::create([
                'titre'           => $validated['titre'],
                'description'     => $validated['description'],
                'datePublication' => $validated['datePublication'] ?? Carbon::today()->toDateString(),
                'date_cloture'    => $validated['date_cloture'] ?? null,
                'statut'          => $validated['statut'],
                'tdr_path'        => $tdrPath,
                'imageId'         => null,
            ]);

            $coverImageId = null;

            foreach ($request->file('images', []) as $uploadedImage) {
                $path = $uploadedImage->store('projects', 'public');

                $image = ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => $path,
                ]);

                if ($coverImageId === null) {
                    $coverImageId = $image->id;
                }
            }

            if ($coverImageId !== null) {
                $project->update(['imageId' => $coverImageId]);
            }
        });

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Projet cree avec succes.');
    }

    public function show(Project $project)
    {
        $project->load(['images', 'coverImage']);
        $candidatures = $project->candidatures()->latest()->paginate(10);

        return view('admin.pages.projects.ShowProject', compact('project', 'candidatures'));
    }

    public function edit(Project $project)
    {
        $project->load(['images', 'coverImage']);

        return view('admin.pages.projects.EditProject', [
            'project'                => $project,
            'defaultPublicationDate' => optional($project->datePublication)->format('Y-m-d') ?? now()->toDateString(),
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'titre'           => ['required', 'string', 'max:255'],
            'description'     => ['required', 'string'],
            'datePublication' => ['nullable', 'date'],
            'date_cloture'    => ['nullable', 'date', 'after_or_equal:datePublication'],
            'statut'          => ['required', 'in:ouvert,ferme,archive'],
            'images'          => ['nullable', 'array'],
            'images.*'        => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'remove_images'   => ['nullable', 'array'],
            'remove_images.*' => ['integer'],
            'cover_image_id'  => ['nullable', 'integer'],
            'tdr'             => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:10240'],
            'remove_tdr'      => ['nullable', 'boolean'],
        ]);

        $project->load('images');

        DB::transaction(function () use ($project, $request, $validated) {
            $tdrPath = $project->tdr_path;

            if (!empty($validated['remove_tdr'])) {
                if ($tdrPath) {
                    Storage::disk('public')->delete($tdrPath);
                }
                $tdrPath = null;
            }

            if ($request->hasFile('tdr')) {
                if ($tdrPath) {
                    Storage::disk('public')->delete($tdrPath);
                }
                $tdrPath = $request->file('tdr')->store('projects/tdr', 'public');
            }

            $project->update([
                'titre'           => $validated['titre'],
                'description'     => $validated['description'],
                'datePublication' => $validated['datePublication'] ?? Carbon::today()->toDateString(),
                'date_cloture'    => $validated['date_cloture'] ?? null,
                'statut'          => $validated['statut'],
                'tdr_path'        => $tdrPath,
            ]);

            $removeImageIds = collect($validated['remove_images'] ?? [])
                ->map(fn ($id) => (int) $id)
                ->all();

            if (!empty($removeImageIds)) {
                $imagesToRemove = $project->images()->whereIn('id', $removeImageIds)->get();

                foreach ($imagesToRemove as $image) {
                    Storage::disk('public')->delete($image->image_path);
                    $image->delete();
                }
            }

            foreach ($request->file('images', []) as $uploadedImage) {
                $path = $uploadedImage->store('projects', 'public');

                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => $path,
                ]);
            }

            $remainingImageIds = $project->images()->pluck('id')->all();
            $requestedCoverId = isset($validated['cover_image_id']) ? (int) $validated['cover_image_id'] : null;

            $coverImageId = in_array($requestedCoverId, $remainingImageIds, true)
                ? $requestedCoverId
                : ($remainingImageIds[0] ?? null);

            $project->update(['imageId' => $coverImageId]);
        });

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Projet mis a jour avec succes.');
    }

    public function destroy(Project $project)
    {
        $project->load('images');

        DB::transaction(function () use ($project) {
            foreach ($project->images as $image) {
                Storage::disk('public')->delete($image->image_path);
            }

            if ($project->tdr_path) {
                Storage::disk('public')->delete($project->tdr_path);
            }

            // CVs des candidatures
            foreach ($project->candidatures as $candidature) {
                if ($candidature->cv_path) {
                    Storage::disk('public')->delete($candidature->cv_path);
                }
            }

            $project->delete();
        });

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Projet supprime avec succes.');
    }
}
