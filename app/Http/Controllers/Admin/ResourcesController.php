<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResourceItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResourcesController extends Controller
{
    public const CATEGORIES = [
        'rapports',
        'documents du projet',
        'guides',
        'supports de formation',
        'publications',
    ];

    public function index()
    {
        $search = request('search');
        $category = request('categorie');
        $direction = request('direction', 'desc');

        $resourcesQuery = ResourceItem::query();

        if ($search) {
            $resourcesQuery->where(function ($query) use ($search) {
                $query->where('titre', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($category && in_array($category, self::CATEGORIES, true)) {
            $resourcesQuery->where('categorie', $category);
        }

        $resources = $resourcesQuery
            ->orderBy('id', $direction === 'asc' ? 'asc' : 'desc')
            ->paginate(7)
            ->withQueryString();

        return view('admin.pages.resources.AllResources', [
            'resources' => $resources,
            'categories' => self::CATEGORIES,
        ]);
    }

    public function create()
    {
        return view('admin.pages.resources.CreateResource', [
            'categories' => self::CATEGORIES,
            'defaultPublicationDate' => now()->toDateString(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'categorie' => ['required', 'string', 'in:' . implode(',', self::CATEGORIES)],
            'description' => ['nullable', 'string'],
            'datePublication' => ['nullable', 'date'],
            'file' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:20480'],
        ]);

        $uploadedFile = $request->file('file');
        $path = $uploadedFile->store('resources', 'public');

        ResourceItem::create([
            'titre' => $validated['titre'],
            'categorie' => $validated['categorie'],
            'description' => $validated['description'] ?? null,
            'file_path' => $path,
            'file_name' => $uploadedFile->getClientOriginalName(),
            'file_type' => strtolower($uploadedFile->getClientOriginalExtension()),
            'datePublication' => $validated['datePublication'] ?? Carbon::today()->toDateString(),
        ]);

        return redirect()
            ->route('admin.resources.index')
            ->with('success', 'Ressource creee avec succes.');
    }

    public function show(ResourceItem $resourceItem)
    {
        return view('admin.pages.resources.ShowResource', [
            'resourceItem' => $resourceItem,
        ]);
    }

    public function edit(ResourceItem $resourceItem)
    {
        return view('admin.pages.resources.EditResource', [
            'resourceItem' => $resourceItem,
            'categories' => self::CATEGORIES,
            'defaultPublicationDate' => optional($resourceItem->datePublication)->format('Y-m-d') ?? now()->toDateString(),
        ]);
    }

    public function update(Request $request, ResourceItem $resourceItem)
    {
        $validated = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'categorie' => ['required', 'string', 'in:' . implode(',', self::CATEGORIES)],
            'description' => ['nullable', 'string'],
            'datePublication' => ['nullable', 'date'],
            'file' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:20480'],
        ]);

        $data = [
            'titre' => $validated['titre'],
            'categorie' => $validated['categorie'],
            'description' => $validated['description'] ?? null,
            'datePublication' => $validated['datePublication'] ?? Carbon::today()->toDateString(),
        ];

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($resourceItem->file_path);

            $uploadedFile = $request->file('file');
            $data['file_path'] = $uploadedFile->store('resources', 'public');
            $data['file_name'] = $uploadedFile->getClientOriginalName();
            $data['file_type'] = strtolower($uploadedFile->getClientOriginalExtension());
        }

        $resourceItem->update($data);

        return redirect()
            ->route('admin.resources.index')
            ->with('success', 'Ressource modifiee avec succes.');
    }

    public function destroy(ResourceItem $resourceItem)
    {
        Storage::disk('public')->delete($resourceItem->file_path);
        $resourceItem->delete();

        return redirect()
            ->route('admin.resources.index')
            ->with('success', 'Ressource supprimee avec succes.');
    }
}
