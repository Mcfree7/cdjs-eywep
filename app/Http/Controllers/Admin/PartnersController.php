<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnersController extends Controller
{
    public function index()
    {
        $search = request('search');
        $direction = request('direction', 'desc');

        $partnersQuery = Partner::query();

        if ($search) {
            $partnersQuery->where('nom', 'like', '%' . $search . '%');
        }

        $partners = $partnersQuery
            ->orderBy('id', $direction === 'asc' ? 'asc' : 'desc')
            ->paginate(7)
            ->withQueryString();

        return view('admin.pages.partners.AllPartners', compact('partners'));
    }

    public function create()
    {
        return view('admin.pages.partners.CreatePartner');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'lien' => ['nullable', 'url', 'max:255'],
            'logo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
        ]);

        $path = $request->file('logo')->store('partners', 'public');

        Partner::create([
            'nom' => $validated['nom'],
            'lien' => $validated['lien'] ?? null,
            'logo_path' => $path,
        ]);

        return redirect()
            ->route('admin.partners.index')
            ->with('success', 'Partenaire cree avec succes.');
    }

    public function show(Partner $partner)
    {
        return view('admin.pages.partners.ShowPartner', compact('partner'));
    }

    public function edit(Partner $partner)
    {
        return view('admin.pages.partners.EditPartner', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'lien' => ['nullable', 'url', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
        ]);

        $data = [
            'nom' => $validated['nom'],
            'lien' => $validated['lien'] ?? null,
        ];

        if ($request->hasFile('logo')) {
            Storage::disk('public')->delete($partner->logo_path);
            $data['logo_path'] = $request->file('logo')->store('partners', 'public');
        }

        $partner->update($data);

        return redirect()
            ->route('admin.partners.index')
            ->with('success', 'Partenaire modifie avec succes.');
    }

    public function destroy(Partner $partner)
    {
        Storage::disk('public')->delete($partner->logo_path);
        $partner->delete();

        return redirect()
            ->route('admin.partners.index')
            ->with('success', 'Partenaire supprime avec succes.');
    }
}
