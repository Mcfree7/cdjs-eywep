<x-mail::message>
# Candidature reçue

Bonjour **{{ $candidature->prenom }} {{ $candidature->nom }}**,

Nous avons bien reçu votre candidature pour le projet **{{ $project->titre }}**.

Voici un résumé des informations enregistrées :

<x-mail::table>
| Champ | Valeur |
|:---|:---|
| Prénom / Nom | {{ $candidature->prenom }} {{ $candidature->nom }} |
| Email | {{ $candidature->email }} |
@if ($candidature->telephone)
| Téléphone | {{ $candidature->telephone }} |
@endif
@if ($candidature->pays)
| Pays | {{ $candidature->pays }} |
@endif
@if ($candidature->sexe)
| Sexe | {{ ucfirst($candidature->sexe) }} |
@endif
| Projet | {{ $project->titre }} |
| Date de soumission | {{ $candidature->created_at->format('d/m/Y à H:i') }} |
</x-mail::table>

Notre équipe examinera votre dossier dans les meilleurs délais. Vous serez contacté(e) à cette adresse e-mail pour la suite du processus.

Merci de l'intérêt que vous portez à nos projets.

<x-mail::button :url="config('app.url')" color="primary">
Visiter notre site
</x-mail::button>

Cordialement,
**L'équipe {{ config('app.name') }}**
</x-mail::message>
