<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public const STATUSES = [
        'actif',
        'inactif',
    ];

    public function index()
    {
        $search = request('search');
        $status = request('status');
        $direction = request('direction', 'desc');

        $newsQuery = News::query();

        if ($search) {
            $newsQuery->where('titre', 'like', '%' . $search . '%');
        }

        if ($status && in_array($status, self::STATUSES, true)) {
            $newsQuery->where('status', $status);
        }

        $news = $newsQuery
            ->orderBy('id', $direction === 'asc' ? 'asc' : 'desc')
            ->paginate(7)
            ->withQueryString();

        return view('admin.pages.news.AllNews', [
            'news' => $news,
            'statuses' => self::STATUSES,
        ]);
    }

    public function create()
    {
        return view('admin.pages.news.CreateNews', [
            'statuses' => self::STATUSES,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'in:' . implode(',', self::STATUSES)],
        ]);

        News::create($validated);

        return redirect()
            ->route('news.index')
            ->with('success', 'Breaking news cree avec succes.');
    }

    public function show(News $news)
    {
        return view('admin.pages.news.ShowNews', compact('news'));
    }

    public function edit(News $news)
    {
        return view('admin.pages.news.EditNews', [
            'news' => $news,
            'statuses' => self::STATUSES,
        ]);
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'in:' . implode(',', self::STATUSES)],
        ]);

        $news->update($validated);

        return redirect()
            ->route('news.index')
            ->with('success', 'Breaking news modifie avec succes.');
    }

    public function destroy(News $news)
    {
        $news->delete();

        return redirect()
            ->route('news.index')
            ->with('success', 'Breaking news supprime avec succes.');
    }
}
