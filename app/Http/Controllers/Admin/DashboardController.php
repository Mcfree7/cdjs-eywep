<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Article;
use App\Models\FrontOfficeSetting;
use App\Models\ResourceItem;
use App\Models\SuccessStory;

class DashboardController extends Controller
{
    public function index()
    {
        $settings = FrontOfficeSetting::firstOrCreate(['id' => 1]);

        $heroImages = collect($settings->hero_images ?? [])
            ->filter()
            ->map(fn (string $path) => asset('storage/' . $path))
            ->values();

        if ($heroImages->isEmpty()) {
            $heroImages = collect([
                asset('admin/dist/assets/img/photo1.png'),
                asset('admin/dist/assets/img/photo2.png'),
                asset('admin/dist/assets/img/photo3.jpg'),
            ]);
        }

        return view('admin.dashboard', [
            'heroImages' => $heroImages,
            'companyName' => $settings->company_name ?: 'EYWEP-CDJS',
            'companySlogan' => $settings->company_slogan ?: 'Informer, inspirer et valoriser les initiatives.',
            'stats' => [
                'articles' => Article::count(),
                'activities' => Activity::count(),
                'resources' => ResourceItem::count(),
                'successStories' => SuccessStory::count(),
            ],
        ]);
    }
}
