<?php

use App\Http\Controllers\Admin\ActivitiesController;
use App\Http\Controllers\Admin\ArticlesController;
use App\Http\Controllers\Admin\CandidaturesController;
use App\Http\Controllers\Admin\FaqsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleriesController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PartnersController;
use App\Http\Controllers\Admin\ProjectsController;
use App\Http\Controllers\Admin\ResourcesController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SuccessStoriesController;
use App\Http\Controllers\FrontOfficeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontOfficeController::class, 'home'])->name('front.home');
Route::get('/articles', [FrontOfficeController::class, 'articles'])->name('front.articles.index');
Route::get('/articles/{article}', [FrontOfficeController::class, 'article'])->name('front.articles.show');
Route::get('/activites', [FrontOfficeController::class, 'activities'])->name('front.activities.index');
Route::get('/activites/{activity}', [FrontOfficeController::class, 'activity'])->name('front.activities.show');
Route::get('/temoignages', [FrontOfficeController::class, 'successStories'])->name('front.success-stories.index');
Route::get('/temoignages/{successStory}', [FrontOfficeController::class, 'successStory'])->name('front.success-stories.show');
Route::get('/galeries', [FrontOfficeController::class, 'galleries'])->name('front.galleries.index');
Route::get('/galeries/{gallery}', [FrontOfficeController::class, 'gallery'])->name('front.galleries.show');
Route::get('/ressources', [FrontOfficeController::class, 'resources'])->name('front.resources.index');
Route::get('/ressources/{resourceItem}', [FrontOfficeController::class, 'resource'])->name('front.resources.show');
Route::get('/ressources/{resourceItem}/telecharger', [FrontOfficeController::class, 'downloadResource'])->name('front.resources.download');
Route::get('/projets', [FrontOfficeController::class, 'projects'])->name('front.projects.index');
Route::get('/projets/{project}', [FrontOfficeController::class, 'project'])->name('front.projects.show');
Route::post('/projets/{project}/candidater', [FrontOfficeController::class, 'applyToProject'])->name('front.projects.apply');
Route::get('/a-propos', [FrontOfficeController::class, 'about'])->name('front.about');
Route::get('/contact', [FrontOfficeController::class, 'contact'])->name('front.contact');

Route::middleware('auth')->group(function () {
    Route::redirect('/dashboard', '/admin/dashboard')->name('dashboard');

    Route::prefix('admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::resource('articles', ArticlesController::class)->names('articles');
        Route::resource('activities', ActivitiesController::class)->names('activities');
        Route::resource('galleries', GalleriesController::class)->names('galleries');
        Route::resource('news', NewsController::class)->names('news');
        Route::resource('success-stories', SuccessStoriesController::class)->names('success-stories');
        Route::resource('partners', PartnersController::class)->names('admin.partners');
        Route::resource('resources', ResourcesController::class)
            ->parameters(['resources' => 'resourceItem'])
            ->names('admin.resources');
        Route::resource('projects', ProjectsController::class)->names('admin.projects');
        Route::resource('faqs', FaqsController::class)->names('admin.faqs');
        Route::get('candidatures/export-stats', [CandidaturesController::class, 'exportStats'])
            ->name('admin.candidatures.export-stats');
        Route::resource('candidatures', CandidaturesController::class)
            ->only(['index', 'show', 'update', 'destroy'])
            ->names('admin.candidatures');

        Route::get('settings/front-office', [SettingsController::class, 'frontOffice'])
            ->name('admin.settings.front-office');
        Route::post('settings/front-office', [SettingsController::class, 'updateFrontOffice'])
            ->name('admin.settings.front-office.update');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
