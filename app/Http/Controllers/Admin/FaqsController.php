<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    public function index()
    {
        $search    = request('search');
        $direction = request('direction', 'asc');

        $query = Faq::query();

        if ($search) {
            $query->where('question', 'like', '%' . $search . '%');
        }

        $faqs = $query
            ->orderBy('ordre', $direction === 'desc' ? 'desc' : 'asc')
            ->orderBy('id', 'asc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.pages.faqs.AllFaqs', compact('faqs'));
    }

    public function create()
    {
        return view('admin.pages.faqs.CreateFaq');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'reponse'  => ['required', 'string'],
            'ordre'    => ['nullable', 'integer', 'min:0'],
            'actif'    => ['nullable', 'boolean'],
        ]);

        Faq::create([
            'question' => $validated['question'],
            'reponse'  => $validated['reponse'],
            'ordre'    => $validated['ordre'] ?? 0,
            'actif'    => $request->boolean('actif', true),
        ]);

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'Question créée avec succès.');
    }

    public function show(Faq $faq)
    {
        return view('admin.pages.faqs.ShowFaq', compact('faq'));
    }

    public function edit(Faq $faq)
    {
        return view('admin.pages.faqs.EditFaq', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'reponse'  => ['required', 'string'],
            'ordre'    => ['nullable', 'integer', 'min:0'],
            'actif'    => ['nullable', 'boolean'],
        ]);

        $faq->update([
            'question' => $validated['question'],
            'reponse'  => $validated['reponse'],
            'ordre'    => $validated['ordre'] ?? 0,
            'actif'    => $request->boolean('actif', true),
        ]);

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'Question modifiée avec succès.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'Question supprimée avec succès.');
    }
}
