<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CandidaturesStatsExport;
use App\Http\Controllers\Controller;
use App\Models\Candidature;
use App\Models\Project;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

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

    public function exportStats(Request $request)
    {
        $validated = $request->validate([
            'format'     => ['required', 'in:pdf,excel'],
            'project_id' => ['nullable', 'integer', 'exists:projects,id'],
            'pays'       => ['nullable', 'string', 'max:100'],
            'sexe'       => ['nullable', 'in:homme,femme,autre'],
        ]);

        $filters = array_filter([
            'project_id' => $validated['project_id'] ?? null,
            'pays'       => $validated['pays'] ?? null,
            'sexe'       => $validated['sexe'] ?? null,
        ]);

        $filename = 'rapport-candidatures-' . now()->format('Y-m-d');

        if ($validated['format'] === 'excel') {
            return Excel::download(new CandidaturesStatsExport($filters), $filename . '.xlsx');
        }

        // PDF
        $baseQuery = Candidature::query();
        if (!empty($filters['project_id'])) {
            $baseQuery->where('project_id', $filters['project_id']);
        }
        if (!empty($filters['pays'])) {
            $baseQuery->where('pays', $filters['pays']);
        }
        if (!empty($filters['sexe'])) {
            $baseQuery->where('sexe', $filters['sexe']);
        }

        $total      = (clone $baseQuery)->count();
        $enAttente  = (clone $baseQuery)->where('statut', 'en_attente')->count();
        $retenue    = (clone $baseQuery)->where('statut', 'retenue')->count();
        $rejetee    = (clone $baseQuery)->where('statut', 'rejetee')->count();
        $nbPays     = (clone $baseQuery)->distinct('pays')->count('pays');
        $nbProjets  = (clone $baseQuery)->distinct('project_id')->count('project_id');

        $hommes     = (clone $baseQuery)->where('sexe', 'homme')->count();
        $femmes     = (clone $baseQuery)->where('sexe', 'femme')->count();
        $autres     = (clone $baseQuery)->where('sexe', 'autre')->count();

        $parPays = (clone $baseQuery)
            ->selectRaw('pays, COUNT(*) as total,
                SUM(CASE WHEN statut = "en_attente" THEN 1 ELSE 0 END) as en_attente,
                SUM(CASE WHEN statut = "retenue" THEN 1 ELSE 0 END) as retenue,
                SUM(CASE WHEN statut = "rejetee" THEN 1 ELSE 0 END) as rejetee')
            ->groupBy('pays')
            ->orderByDesc('total')
            ->get();

        $parProjet = (clone $baseQuery)
            ->with('project')
            ->selectRaw('project_id, COUNT(*) as total,
                SUM(CASE WHEN statut = "en_attente" THEN 1 ELSE 0 END) as en_attente,
                SUM(CASE WHEN statut = "retenue" THEN 1 ELSE 0 END) as retenue,
                SUM(CASE WHEN statut = "rejetee" THEN 1 ELSE 0 END) as rejetee')
            ->groupBy('project_id')
            ->orderByDesc('total')
            ->get();

        $parSexe = (clone $baseQuery)
            ->selectRaw('sexe, COUNT(*) as total,
                SUM(CASE WHEN statut = "en_attente" THEN 1 ELSE 0 END) as en_attente,
                SUM(CASE WHEN statut = "retenue" THEN 1 ELSE 0 END) as retenue,
                SUM(CASE WHEN statut = "rejetee" THEN 1 ELSE 0 END) as rejetee')
            ->groupBy('sexe')
            ->orderByDesc('total')
            ->get();

        $filtreProjet = null;
        if (!empty($filters['project_id'])) {
            $filtreProjet = Project::find($filters['project_id'])?->titre;
        }
        $filtrePays = $filters['pays'] ?? null;
        $filtreSexe = $filters['sexe'] ?? null;

        $candidatures = (clone $baseQuery)
            ->with('project')
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = Pdf::loadView('admin.pages.candidatures.rapport-stats-pdf', compact(
            'total', 'enAttente', 'retenue', 'rejetee',
            'nbPays', 'nbProjets', 'hommes', 'femmes', 'autres',
            'parPays', 'parProjet', 'parSexe',
            'filtreProjet', 'filtrePays', 'filtreSexe', 'candidatures'
        ))->setPaper('a4', 'landscape');

        return $pdf->download($filename . '.pdf');
    }

    public function destroy(Candidature $candidature)
    {
        foreach (['cv_path', 'piece_identite_path', 'lettre_motivation_path', 'business_plan_path', 'plan_financier_path', 'documents_legaux_path', 'autres_activites_path'] as $field) {
            if ($candidature->$field) {
                Storage::disk('public')->delete($candidature->$field);
            }
        }

        $candidature->delete();

        return back()->with('success', 'Candidature supprimée avec succès.');
    }
}
