<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CandidaturesController extends Controller
{
    public function index()
    {
        $search = request('search');
        $projectId = request('project_id');
        $statut = request('statut');
        $sort = request('sort', 'id');
        $direction = request('direction', 'desc');

        $allowedSorts = ['id', 'nom', 'email', 'statut', 'created_at'];
        $allowedDirections = ['asc', 'desc'];

        if (!in_array($sort, $allowedSorts, true)) {
            $sort = 'id';
        }

        if (!in_array($direction, $allowedDirections, true)) {
            $direction = 'desc';
        }

        $query = Candidature::with('project');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', '%' . $search . '%')
                    ->orWhere('prenom', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        if ($projectId) {
            $query->where('project_id', $projectId);
        }

        if ($statut) {
            $query->where('statut', $statut);
        }

        $query->orderBy($sort, $direction);

        $candidatures = $query->paginate(10)->withQueryString();
        $projects = Project::orderBy('titre')->get();

        return view('admin.pages.candidatures.AllCandidatures', compact('candidatures', 'projects'));
    }

    public function show(Candidature $candidature)
    {
        $candidature->load('project');

        return view('admin.pages.candidatures.ShowCandidature', compact('candidature'));
    }

    public function update(Request $request, Candidature $candidature)
    {
        $validated = $request->validate([
            'statut' => ['required', 'in:en_attente,retenue,rejetee'],
        ]);

        $candidature->update(['statut' => $validated['statut']]);

        return back()->with('success', 'Statut de la candidature mis a jour.');
    }

    public function destroy(Candidature $candidature)
    {
        if ($candidature->cv_path) {
            Storage::disk('public')->delete($candidature->cv_path);
        }

        $candidature->delete();

        return back()->with('success', 'Candidature supprimee avec succes.');
    }
}
