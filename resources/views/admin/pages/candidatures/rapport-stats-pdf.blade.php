<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport Statistiques - Candidatures</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #1e293b; background: #fff; }

        .header { background: #1e40af; color: #fff; padding: 20px 24px; margin-bottom: 20px; }
        .header h1 { font-size: 18px; font-weight: 700; margin-bottom: 4px; }
        .header p { font-size: 11px; opacity: 0.85; }

        .filters-bar { background: #f1f5f9; border-left: 3px solid #3b82f6; padding: 8px 12px; margin-bottom: 18px; font-size: 10px; color: #475569; }
        .filters-bar strong { color: #1e293b; }

        .section-title { font-size: 13px; font-weight: 700; color: #1e40af; border-bottom: 2px solid #bfdbfe; padding-bottom: 5px; margin-bottom: 10px; margin-top: 20px; }
        .section-title:first-of-type { margin-top: 0; }

        table { width: 100%; border-collapse: collapse; margin-bottom: 16px; font-size: 10px; }
        thead tr { background: #1e40af; color: #fff; }
        thead th { padding: 7px 10px; text-align: left; font-weight: 600; }
        tbody tr:nth-child(even) { background: #f8fafc; }
        tbody td { padding: 6px 10px; border-bottom: 1px solid #e2e8f0; }

        table.candidatures-list { font-size: 9px; }
        table.candidatures-list thead th { padding: 6px 7px; }
        table.candidatures-list tbody td { padding: 5px 7px; }

        .badge { display: inline-block; padding: 2px 7px; border-radius: 10px; font-size: 9px; font-weight: 600; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-danger  { background: #fee2e2; color: #991b1b; }

        .summary-grid { width: 100%; margin-bottom: 18px; }
        .summary-grid td { width: 33.33%; vertical-align: top; padding: 0 6px 0 0; }
        .stat-card { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 12px 14px; text-align: center; }
        .stat-card .value { font-size: 28px; font-weight: 700; color: #1e40af; line-height: 1; }
        .stat-card .label { font-size: 10px; color: #64748b; margin-top: 4px; }
        .stat-card.green .value { color: #059669; }
        .stat-card.red .value   { color: #dc2626; }
        .stat-card.orange .value { color: #d97706; }

        .footer { margin-top: 30px; padding-top: 10px; border-top: 1px solid #e2e8f0; font-size: 9px; color: #94a3b8; text-align: center; }

        .pct-bar { background: #e2e8f0; border-radius: 4px; height: 6px; width: 100%; overflow: hidden; display: inline-block; vertical-align: middle; margin-left: 6px; }
        .pct-bar-fill { background: #3b82f6; height: 6px; border-radius: 4px; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Rapport Statistiques — Candidatures</h1>
        <p>Généré le {{ now()->format('d/m/Y à H:i') }}</p>
    </div>

    @if($filtreProjet || $filtrePays)
    <div class="filters-bar">
        Filtres appliqués :
        @if($filtreProjet) <strong>Projet :</strong> {{ $filtreProjet }} &nbsp;|&nbsp; @endif
        @if($filtrePays) <strong>Pays :</strong> {{ $filtrePays }} @endif
    </div>
    @endif

    {{-- Résumé --}}
    <div class="section-title">Résumé global</div>
    <table class="summary-grid">
        <tr>
            <td>
                <div class="stat-card">
                    <div class="value">{{ $total }}</div>
                    <div class="label">Total candidatures</div>
                </div>
            </td>
            <td>
                <div class="stat-card orange">
                    <div class="value">{{ $enAttente }}</div>
                    <div class="label">En attente</div>
                </div>
            </td>
            <td style="padding-right:0">
                <div class="stat-card green">
                    <div class="value">{{ $retenue }}</div>
                    <div class="label">Retenues</div>
                </div>
            </td>
        </tr>
    </table>
    <table class="summary-grid" style="margin-top: -10px;">
        <tr>
            <td>
                <div class="stat-card red">
                    <div class="value">{{ $rejetee }}</div>
                    <div class="label">Rejetées</div>
                </div>
            </td>
            <td>
                <div class="stat-card">
                    <div class="value">{{ $nbPays }}</div>
                    <div class="label">Pays représentés</div>
                </div>
            </td>
            <td style="padding-right:0">
                <div class="stat-card">
                    <div class="value">{{ $nbProjets }}</div>
                    <div class="label">Projets concernés</div>
                </div>
            </td>
        </tr>
    </table>

    {{-- Par pays --}}
    <div class="section-title">Répartition par pays</div>
    <table>
        <thead>
            <tr>
                <th>Pays</th>
                <th>Total</th>
                <th>En attente</th>
                <th>Retenue</th>
                <th>Rejetée</th>
                <th>% Retenue</th>
            </tr>
        </thead>
        <tbody>
            @forelse($parPays as $row)
                @php $pct = $row->total > 0 ? round(($row->retenue / $row->total) * 100) : 0; @endphp
                <tr>
                    <td>{{ $row->pays ?: '(non renseigné)' }}</td>
                    <td><strong>{{ $row->total }}</strong></td>
                    <td><span class="badge badge-warning">{{ $row->en_attente }}</span></td>
                    <td><span class="badge badge-success">{{ $row->retenue }}</span></td>
                    <td><span class="badge badge-danger">{{ $row->rejetee }}</span></td>
                    <td>{{ $pct }}%</td>
                </tr>
            @empty
                <tr><td colspan="6" style="text-align:center; color:#94a3b8;">Aucune donnée</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- Par projet --}}
    <div class="section-title">Répartition par projet</div>
    <table>
        <thead>
            <tr>
                <th>Projet</th>
                <th>Total</th>
                <th>En attente</th>
                <th>Retenue</th>
                <th>Rejetée</th>
                <th>% Retenue</th>
            </tr>
        </thead>
        <tbody>
            @forelse($parProjet as $row)
                @php $pct = $row->total > 0 ? round(($row->retenue / $row->total) * 100) : 0; @endphp
                <tr>
                    <td>{{ $row->project?->titre ?? 'Projet #'.$row->project_id }}</td>
                    <td><strong>{{ $row->total }}</strong></td>
                    <td><span class="badge badge-warning">{{ $row->en_attente }}</span></td>
                    <td><span class="badge badge-success">{{ $row->retenue }}</span></td>
                    <td><span class="badge badge-danger">{{ $row->rejetee }}</span></td>
                    <td>{{ $pct }}%</td>
                </tr>
            @empty
                <tr><td colspan="6" style="text-align:center; color:#94a3b8;">Aucune donnée</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- Liste des candidatures --}}
    <div class="section-title" style="page-break-before: always;">Liste des candidatures</div>
    <table class="candidatures-list">
        <thead>
            <tr>
                <th>#</th>
                <th>Candidat</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Pays</th>
                <th>Sexe</th>
                <th>Projet</th>
                <th>Statut</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($candidatures as $c)
                @php
                    $badgeClass = match($c->statut) {
                        'retenue'   => 'badge-success',
                        'rejetee'   => 'badge-danger',
                        default     => 'badge-warning',
                    };
                    $statutLabel = match($c->statut) {
                        'retenue'   => 'Retenue',
                        'rejetee'   => 'Rejetée',
                        default     => 'En attente',
                    };
                @endphp
                <tr>
                    <td>{{ $c->id }}</td>
                    <td><strong>{{ $c->prenom }} {{ $c->nom }}</strong></td>
                    <td>{{ $c->email }}</td>
                    <td>{{ $c->telephone }}</td>
                    <td>{{ $c->pays }}</td>
                    <td>{{ $c->sexe }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($c->project?->titre, 35) }}</td>
                    <td><span class="badge {{ $badgeClass }}">{{ $statutLabel }}</span></td>
                    <td style="white-space:nowrap;">{{ $c->created_at->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="9" style="text-align:center; color:#94a3b8;">Aucune candidature</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        EYWEP / CDJS &mdash; Rapport généré automatiquement &mdash; {{ now()->format('d/m/Y') }}
    </div>

</body>
</html>
