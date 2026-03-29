<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Article;
use App\Models\Candidature;
use App\Models\Faq;
use App\Models\FrontOfficeSetting;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Partner;
use App\Models\Project;
use App\Models\ResourceItem;
use App\Models\SuccessStory;
use App\Mail\CandidatureConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class FrontOfficeController extends Controller
{
    public function home()
    {
        return view('front.home', [
            'settings' => $this->settings(),
            'articles' => Article::with('coverImage')
                ->latest('datePublication')
                ->latest('id')
                ->take(4)
                ->get(),
            'activities' => Activity::with('coverImage')
                ->latest('datePublication')
                ->latest('id')
                ->take(5)
                ->get(),
            'successStories' => SuccessStory::with('coverImage')
                ->latest('datePublication')
                ->latest('id')
                ->take(3)
                ->get(),
            'galleries' => Gallery::with('medias')
                ->latest('id')
                ->take(4)
                ->get(),
            'resources' => ResourceItem::query()
                ->latest('datePublication')
                ->latest('id')
                ->take(6)
                ->get(),
            'partners' => Partner::query()
                ->latest('id')
                ->get(),
            'news' => News::query()
                ->where('status', 'actif')
                ->latest('id')
                ->take(5)
                ->get(),
            'faqs' => Faq::actif()
                ->orderBy('ordre')
                ->orderBy('id')
                ->take(5)
                ->get(),
            'projects' => Project::withCount('candidatures')
                ->with('coverImage')
                ->where('statut', '!=', 'archive')
                ->latest('datePublication')
                ->latest('id')
                ->take(6)
                ->get(),
        ]);
    }

    public function articles()
    {
        return view('front.articles.index', [
            'settings' => $this->settings(),
            'articles' => Article::with('coverImage')
                ->latest('datePublication')
                ->latest('id')
                ->paginate(9),
        ]);
    }

    public function article(Article $article)
    {
        return view('front.articles.show', [
            'settings' => $this->settings(),
            'article' => $article->load(['coverImage', 'images']),
            'relatedArticles' => Article::with('coverImage')
                ->whereKeyNot($article->id)
                ->latest('datePublication')
                ->latest('id')
                ->take(3)
                ->get(),
        ]);
    }

    public function activities()
    {
        return view('front.activities.index', [
            'settings' => $this->settings(),
            'activities' => Activity::with('coverImage')
                ->latest('datePublication')
                ->latest('id')
                ->paginate(9),
        ]);
    }

    public function activity(Activity $activity)
    {
        return view('front.activities.show', [
            'settings' => $this->settings(),
            'activity' => $activity->load(['coverImage', 'images']),
            'relatedActivities' => Activity::with('coverImage')
                ->whereKeyNot($activity->id)
                ->latest('datePublication')
                ->latest('id')
                ->take(3)
                ->get(),
        ]);
    }

    public function successStories()
    {
        return view('front.success-stories.index', [
            'settings' => $this->settings(),
            'successStories' => SuccessStory::with('coverImage')
                ->latest('datePublication')
                ->latest('id')
                ->paginate(9),
        ]);
    }

    public function successStory(SuccessStory $successStory)
    {
        return view('front.success-stories.show', [
            'settings' => $this->settings(),
            'successStory' => $successStory->load(['coverImage', 'images']),
            'relatedStories' => SuccessStory::with('coverImage')
                ->whereKeyNot($successStory->id)
                ->latest('datePublication')
                ->latest('id')
                ->take(3)
                ->get(),
        ]);
    }

    public function galleries()
    {
        return view('front.galleries.index', [
            'settings' => $this->settings(),
            'galleries' => Gallery::with('medias')
                ->latest('id')
                ->paginate(9),
        ]);
    }

    public function gallery(Gallery $gallery)
    {
        return view('front.galleries.show', [
            'settings' => $this->settings(),
            'gallery' => $gallery->load('medias'),
            'otherGalleries' => Gallery::with('medias')
                ->whereKeyNot($gallery->id)
                ->latest('id')
                ->take(3)
                ->get(),
        ]);
    }

    public function resources()
    {
        return view('front.resources.index', [
            'settings' => $this->settings(),
            'resources' => ResourceItem::query()
                ->latest('datePublication')
                ->latest('id')
                ->paginate(12),
        ]);
    }

    public function resource(ResourceItem $resourceItem)
    {
        return view('front.resources.show', [
            'settings' => $this->settings(),
            'resourceItem' => $resourceItem,
            'relatedResources' => ResourceItem::query()
                ->where('categorie', $resourceItem->categorie)
                ->whereKeyNot($resourceItem->id)
                ->latest('datePublication')
                ->latest('id')
                ->take(4)
                ->get(),
        ]);
    }

    public function downloadResource(ResourceItem $resourceItem)
    {
        return Response::download(
            storage_path('app/public/' . $resourceItem->file_path),
            $resourceItem->file_name
        );
    }

    public function projects()
    {
        return view('front.projects.index', [
            'settings' => $this->settings(),
            'projects' => Project::withCount('candidatures')
                ->with('coverImage')
                ->where('statut', '!=', 'archive')
                ->latest('datePublication')
                ->latest('id')
                ->paginate(9),
        ]);
    }

    public function project(Project $project)
    {
        return view('front.projects.show', [
            'settings' => $this->settings(),
            'project'  => $project->load(['coverImage', 'images']),
            'candidaturesCount' => $project->candidatures()->count(),
        ]);
    }

    public function applyToProject(Request $request, Project $project)
    {
        if ($project->statut !== 'ouvert') {
            return back()->with('error', 'Les candidatures pour ce projet sont fermées.');
        }

        $validated = $request->validate([
            'nom'                => ['required', 'string', 'max:100'],
            'prenom'             => ['required', 'string', 'max:100'],
            'pays'               => ['nullable', 'string', 'max:100'],
            'sexe'               => ['nullable', 'in:homme,femme,autre'],
            'email'              => ['required', 'email', 'max:255'],
            'telephone'          => ['nullable', 'string', 'max:30'],
            'lettre_motivation'  => ['required', 'file', 'mimes:pdf', 'max:5120'],
            'cv'                 => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            'piece_identite'     => ['required', 'file', 'mimes:pdf', 'max:5120'],
        ]);

        $lettreMotivationPath = $request->file('lettre_motivation')->store('candidatures/lettres-motivation', 'public');
        $cvPath               = $request->file('cv')->store('candidatures/cv', 'public');
        $pieceIdentitePath    = $request->file('piece_identite')->store('candidatures/pieces-identite', 'public');

        $candidature = Candidature::create([
            'project_id'             => $project->id,
            'nom'                    => $validated['nom'],
            'prenom'                 => $validated['prenom'],
            'pays'                   => $validated['pays'] ?? null,
            'sexe'                   => $validated['sexe'] ?? null,
            'email'                  => $validated['email'],
            'telephone'              => $validated['telephone'] ?? null,
            'lettre_motivation_path' => $lettreMotivationPath,
            'cv_path'                => $cvPath,
            'piece_identite_path'    => $pieceIdentitePath,
            'statut'                 => 'en_attente',
        ]);

        try {
            Mail::to($candidature->email)->send(new CandidatureConfirmation($candidature, $project));
        } catch (\Throwable) {
            // L'envoi d'email ne doit pas bloquer la soumission
        }

        return back()->with('success', 'Votre candidature a bien été envoyée. Un e-mail de confirmation vous a été transmis.');
    }

    public function about()
    {
        return view('front.about', [
            'settings' => $this->settings(),
            'partners' => Partner::query()->latest('id')->get(),
            'faqs'     => Faq::actif()->orderBy('ordre')->orderBy('id')->take(5)->get(),
        ]);
    }

    public function contact()
    {
        return view('front.contact', [
            'settings' => $this->settings(),
        ]);
    }

    private function settings(): FrontOfficeSetting
    {
        return FrontOfficeSetting::firstOrCreate(
            ['id' => 1],
            [
                'company_name' => 'EYWEP-CDJS',
                'company_slogan' => 'Informer, inspirer et valoriser les initiatives.',
                'primary_color' => '#0d6efd',
                'hero_title' => 'Bienvenue sur notre plateforme',
                'hero_subtitle' => "Presente ici la mission, l'impact ou l'actualite principale du front office.",
                'company_address' => 'Ouagadougou, Burkina Faso',
            ]
        );
    }
}
