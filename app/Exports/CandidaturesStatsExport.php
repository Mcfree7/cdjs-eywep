<?php

namespace App\Exports;

use App\Models\Candidature;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CandidaturesStatsExport implements WithMultipleSheets
{
    protected array $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function sheets(): array
    {
        return [
            new CandidaturesStatsResumeSheet($this->filters),
            new CandidaturesStatsParSexeSheet($this->filters),
            new CandidaturesStatsParPaysSheet($this->filters),
            new CandidaturesStatsParProjetSheet($this->filters),
            new CandidaturesListeSheet($this->filters),
        ];
    }
}

// ── Trait partagé pour appliquer les filtres ─────────────────────────────────
trait WithFilteredQuery
{
    protected function baseQuery()
    {
        $query = Candidature::query();
        if (!empty($this->filters['project_id'])) {
            $query->where('project_id', $this->filters['project_id']);
        }
        if (!empty($this->filters['pays'])) {
            $query->where('pays', $this->filters['pays']);
        }
        if (!empty($this->filters['sexe'])) {
            $query->where('sexe', $this->filters['sexe']);
        }
        return $query;
    }
}

// ── Feuille Résumé ────────────────────────────────────────────────────────────
class CandidaturesStatsResumeSheet implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    use WithFilteredQuery;
    protected array $filters;

    public function __construct(array $filters) { $this->filters = $filters; }
    public function title(): string { return 'Résumé'; }
    public function headings(): array { return ['Indicateur', 'Valeur']; }

    public function collection(): Collection
    {
        $q = $this->baseQuery();
        $total      = (clone $q)->count();
        $en_attente = (clone $q)->where('statut', 'en_attente')->count();
        $retenue    = (clone $q)->where('statut', 'retenue')->count();
        $rejetee    = (clone $q)->where('statut', 'rejetee')->count();
        $hommes     = (clone $q)->where('sexe', 'homme')->count();
        $femmes     = (clone $q)->where('sexe', 'femme')->count();
        $autres     = (clone $q)->where('sexe', 'autre')->count();
        $nbPays     = (clone $q)->distinct('pays')->count('pays');
        $nbProjets  = (clone $q)->distinct('project_id')->count('project_id');

        $rows = collect([
            ['Total candidatures',          $total],
            ['',                            ''],
            ['Statut : En attente',         $en_attente],
            ['Statut : Retenue',            $retenue],
            ['Statut : Rejetée',            $rejetee],
            ['',                            ''],
            ['Sexe : Homme',                $hommes],
            ['Sexe : Femme',                $femmes],
            ['Sexe : Autre',                $autres],
            ['',                            ''],
            ['Pays représentés',            $nbPays],
            ['Projets concernés',           $nbProjets],
        ]);

        if (!empty($this->filters['pays'])) {
            $rows->prepend(['Filtre pays', $this->filters['pays']]);
        }
        if (!empty($this->filters['sexe'])) {
            $rows->prepend(['Filtre sexe', ucfirst($this->filters['sexe'])]);
        }
        if (!empty($this->filters['project_id'])) {
            $project = \App\Models\Project::find($this->filters['project_id']);
            $rows->prepend(['Filtre projet', $project?->titre ?? $this->filters['project_id']]);
        }

        return $rows;
    }

    public function styles(Worksheet $sheet): array { return [1 => ['font' => ['bold' => true, 'size' => 12]]]; }
    public function columnWidths(): array { return ['A' => 35, 'B' => 20]; }
}

// ── Feuille Par sexe ──────────────────────────────────────────────────────────
class CandidaturesStatsParSexeSheet implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    use WithFilteredQuery;
    protected array $filters;

    public function __construct(array $filters) { $this->filters = $filters; }
    public function title(): string { return 'Par sexe'; }
    public function headings(): array { return ['Sexe', 'Total', 'En attente', 'Retenue', 'Rejetée', '% Retenue']; }

    public function collection(): Collection
    {
        $sexeLabels = ['homme' => 'Homme', 'femme' => 'Femme', 'autre' => 'Autre'];

        return $this->baseQuery()
            ->selectRaw('sexe, COUNT(*) as total,
                SUM(CASE WHEN statut = "en_attente" THEN 1 ELSE 0 END) as en_attente,
                SUM(CASE WHEN statut = "retenue" THEN 1 ELSE 0 END) as retenue,
                SUM(CASE WHEN statut = "rejetee" THEN 1 ELSE 0 END) as rejetee')
            ->groupBy('sexe')
            ->orderByDesc('total')
            ->get()
            ->map(fn($r) => [
                $sexeLabels[$r->sexe] ?? ($r->sexe ?: '(non renseigné)'),
                $r->total,
                $r->en_attente,
                $r->retenue,
                $r->rejetee,
                $r->total > 0 ? round(($r->retenue / $r->total) * 100, 1) . '%' : '0%',
            ]);
    }

    public function styles(Worksheet $sheet): array { return [1 => ['font' => ['bold' => true]]]; }
    public function columnWidths(): array { return ['A' => 18, 'B' => 10, 'C' => 12, 'D' => 10, 'E' => 10, 'F' => 12]; }
}

// ── Feuille Par pays ──────────────────────────────────────────────────────────
class CandidaturesStatsParPaysSheet implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    use WithFilteredQuery;
    protected array $filters;

    public function __construct(array $filters) { $this->filters = $filters; }
    public function title(): string { return 'Par pays'; }
    public function headings(): array { return ['Pays', 'Total', 'En attente', 'Retenue', 'Rejetée', '% Retenue']; }

    public function collection(): Collection
    {
        return $this->baseQuery()
            ->selectRaw('pays, COUNT(*) as total,
                SUM(CASE WHEN statut = "en_attente" THEN 1 ELSE 0 END) as en_attente,
                SUM(CASE WHEN statut = "retenue" THEN 1 ELSE 0 END) as retenue,
                SUM(CASE WHEN statut = "rejetee" THEN 1 ELSE 0 END) as rejetee')
            ->groupBy('pays')
            ->orderByDesc('total')
            ->get()
            ->map(fn($r) => [
                $r->pays ?: '(non renseigné)',
                $r->total,
                $r->en_attente,
                $r->retenue,
                $r->rejetee,
                $r->total > 0 ? round(($r->retenue / $r->total) * 100, 1) . '%' : '0%',
            ]);
    }

    public function styles(Worksheet $sheet): array { return [1 => ['font' => ['bold' => true]]]; }
    public function columnWidths(): array { return ['A' => 25, 'B' => 10, 'C' => 12, 'D' => 10, 'E' => 10, 'F' => 12]; }
}

// ── Feuille Par projet ────────────────────────────────────────────────────────
class CandidaturesStatsParProjetSheet implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    use WithFilteredQuery;
    protected array $filters;

    public function __construct(array $filters) { $this->filters = $filters; }
    public function title(): string { return 'Par projet'; }
    public function headings(): array { return ['Projet', 'Total', 'En attente', 'Retenue', 'Rejetée', '% Retenue']; }

    public function collection(): Collection
    {
        return $this->baseQuery()
            ->with('project')
            ->selectRaw('project_id, COUNT(*) as total,
                SUM(CASE WHEN statut = "en_attente" THEN 1 ELSE 0 END) as en_attente,
                SUM(CASE WHEN statut = "retenue" THEN 1 ELSE 0 END) as retenue,
                SUM(CASE WHEN statut = "rejetee" THEN 1 ELSE 0 END) as rejetee')
            ->groupBy('project_id')
            ->orderByDesc('total')
            ->get()
            ->map(fn($r) => [
                $r->project?->titre ?? 'Projet #' . $r->project_id,
                $r->total,
                $r->en_attente,
                $r->retenue,
                $r->rejetee,
                $r->total > 0 ? round(($r->retenue / $r->total) * 100, 1) . '%' : '0%',
            ]);
    }

    public function styles(Worksheet $sheet): array { return [1 => ['font' => ['bold' => true]]]; }
    public function columnWidths(): array { return ['A' => 40, 'B' => 10, 'C' => 12, 'D' => 10, 'E' => 10, 'F' => 12]; }
}

// ── Feuille Liste détaillée ───────────────────────────────────────────────────
class CandidaturesListeSheet implements FromCollection, WithHeadings, WithTitle, WithStyles
{
    use WithFilteredQuery;
    protected array $filters;

    public function __construct(array $filters) { $this->filters = $filters; }
    public function title(): string { return 'Liste détaillée'; }
    public function headings(): array { return ['#', 'Nom', 'Prénom', 'Email', 'Téléphone', 'Pays', 'Sexe', 'Projet', 'Statut', 'Date']; }

    public function collection(): Collection
    {
        $statutLabels = ['en_attente' => 'En attente', 'retenue' => 'Retenue', 'rejetee' => 'Rejetée'];
        $sexeLabels   = ['homme' => 'Homme', 'femme' => 'Femme', 'autre' => 'Autre'];

        return $this->baseQuery()
            ->with('project')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(fn($c) => [
                $c->id,
                $c->nom,
                $c->prenom,
                $c->email,
                $c->telephone,
                $c->pays,
                $sexeLabels[$c->sexe] ?? $c->sexe,
                $c->project?->titre,
                $statutLabels[$c->statut] ?? $c->statut,
                $c->created_at->format('d/m/Y'),
            ]);
    }

    public function styles(Worksheet $sheet): array { return [1 => ['font' => ['bold' => true]]]; }
}
