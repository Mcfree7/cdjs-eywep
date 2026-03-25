<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

        $articlesQuery = Article::with(['images', 'coverImage']);

        if ($search) {
            $articlesQuery->where(function ($query) use ($search) {
                $query->where('titre', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($publicationDate) {
            $articlesQuery->whereDate('datePublication', $publicationDate);
        }

        $articlesQuery->orderBy($sort, $direction);

        if ($sort !== 'id') {
            $articlesQuery->orderByDesc('id');
        }

        $articles = $articlesQuery
            ->paginate(7)
            ->withQueryString();

        return view('admin.pages.articles.AllArticles', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.articles.CreateArticle', [
            'defaultPublicationDate' => now()->toDateString(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
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
            $article = Article::create([
                'titre' => $validated['titre'],
                'description' => $validated['description'],
                'datePublication' => $validated['datePublication'] ?? Carbon::today()->toDateString(),
                'imageId' => null,
            ]);

            $coverImageId = null;

            foreach ($request->file('images', []) as $uploadedImage) {
                $path = $uploadedImage->store('articles', 'public');

                $image = ArticleImage::create([
                    'article_id' => $article->id,
                    'image_path' => $path,
                ]);

                if ($coverImageId === null) {
                    $coverImageId = $image->id;
                }
            }

            if ($coverImageId !== null) {
                $article->update(['imageId' => $coverImageId]);
            }
        });

        return redirect()
            ->route('articles.index')
            ->with('success', 'Article cree avec succes.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $article->load(['images', 'coverImage']);

        return view('admin.pages.articles.ShowArticle', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $article->load(['images', 'coverImage']);

        return view('admin.pages.articles.EditArticle', [
            'article' => $article,
            'defaultPublicationDate' => optional($article->datePublication)->format('Y-m-d') ?? now()->toDateString(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
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

        $article->load('images');

        DB::transaction(function () use ($article, $request, $validated) {
            $article->update([
                'titre' => $validated['titre'],
                'description' => $validated['description'],
                'datePublication' => $validated['datePublication'] ?? Carbon::today()->toDateString(),
            ]);

            $removeImageIds = collect($validated['remove_images'] ?? [])
                ->map(fn ($id) => (int) $id)
                ->all();

            if (!empty($removeImageIds)) {
                $imagesToRemove = $article->images()->whereIn('id', $removeImageIds)->get();

                foreach ($imagesToRemove as $image) {
                    Storage::disk('public')->delete($image->image_path);
                    $image->delete();
                }
            }

            $newImageIds = [];

            foreach ($request->file('images', []) as $uploadedImage) {
                $path = $uploadedImage->store('articles', 'public');

                $image = ArticleImage::create([
                    'article_id' => $article->id,
                    'image_path' => $path,
                ]);

                $newImageIds[] = $image->id;
            }

            $remainingImageIds = $article->images()->pluck('id')->all();
            $requestedCoverId = isset($validated['cover_image_id']) ? (int) $validated['cover_image_id'] : null;

            $coverImageId = in_array($requestedCoverId, $remainingImageIds, true)
                ? $requestedCoverId
                : ($remainingImageIds[0] ?? null);

            $article->update([
                'imageId' => $coverImageId,
            ]);
        });

        return redirect()
            ->route('articles.index')
            ->with('success', 'Article modifie avec succes.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->load('images');

        DB::transaction(function () use ($article) {
            foreach ($article->images as $image) {
                Storage::disk('public')->delete($image->image_path);
            }

            $article->delete();
        });

        return redirect()
            ->route('articles.index')
            ->with('success', 'Article supprime avec succes.');
    }
}
