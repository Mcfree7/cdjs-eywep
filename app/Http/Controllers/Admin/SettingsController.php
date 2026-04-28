<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FrontOfficeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function frontOffice()
    {
        $settings = FrontOfficeSetting::firstOrCreate(
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

        return view('admin.pages.settings.FrontOfficeSettings', compact('settings'));
    }

    public function updateFrontOffice(Request $request)
    {
        $settings = FrontOfficeSetting::firstOrCreate(['id' => 1]);

        $validated = $request->validate([
            'company_name' => ['nullable', 'string', 'max:255'],
            'company_slogan' => ['nullable', 'string', 'max:255'],
            'company_logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
            'primary_color' => ['nullable', 'string', 'max:20'],
            'hero_images' => ['nullable', 'array'],
            'hero_images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'hero_video_file' => ['nullable', 'file', 'mimes:mp4,mov,avi,webm', 'max:20480'],
            'hero_video' => ['nullable', 'url', 'max:255'],
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_subtitle' => ['nullable', 'string'],
            'company_address' => ['nullable', 'string', 'max:255'],
            'company_location' => ['nullable', 'url', 'max:500'],
            'company_phone' => ['nullable', 'string', 'max:255'],
            'company_email' => ['nullable', 'email', 'max:255'],
            'social_facebook' => ['nullable', 'url', 'max:255'],
            'social_linkedin' => ['nullable', 'url', 'max:255'],
            'social_twitter' => ['nullable', 'url', 'max:255'],
            'social_whatsapp' => ['nullable', 'url', 'max:255'],
            'footer_links' => ['nullable', 'array'],
            'footer_links.*.label' => ['required_with:footer_links.*', 'string', 'max:100'],
            'footer_links.*.url' => ['required_with:footer_links.*', 'string', 'max:500'],
            'remove_hero_images' => ['nullable', 'boolean'],
            'remove_hero_video_file' => ['nullable', 'boolean'],
        ]);

        $data = [
            'company_name' => $validated['company_name'] ?? null,
            'company_slogan' => $validated['company_slogan'] ?? null,
            'primary_color' => $validated['primary_color'] ?? '#0d6efd',
            'hero_video_url' => $validated['hero_video'] ?? null,
            'hero_title' => $validated['hero_title'] ?? null,
            'hero_subtitle' => $validated['hero_subtitle'] ?? null,
            'company_address' => $validated['company_address'] ?? null,
            'company_location' => $validated['company_location'] ?? null,
            'company_phone' => $validated['company_phone'] ?? null,
            'company_email' => $validated['company_email'] ?? null,
            'social_facebook' => $validated['social_facebook'] ?? null,
            'social_linkedin' => $validated['social_linkedin'] ?? null,
            'social_twitter' => $validated['social_twitter'] ?? null,
            'social_whatsapp' => $validated['social_whatsapp'] ?? null,
            'footer_links' => array_values(array_filter(
                $validated['footer_links'] ?? [],
                fn($l) => !empty($l['label']) && !empty($l['url'])
            )),
        ];

        if ($request->hasFile('company_logo')) {
            if ($settings->company_logo_path) {
                Storage::disk('public')->delete($settings->company_logo_path);
            }

            $data['company_logo_path'] = $request->file('company_logo')->store('settings', 'public');
        }

        if ($request->boolean('remove_hero_images')) {
            foreach ($settings->hero_images ?? [] as $path) {
                Storage::disk('public')->delete($path);
            }

            $data['hero_images'] = [];
        }

        if ($request->hasFile('hero_images')) {
            foreach ($settings->hero_images ?? [] as $path) {
                Storage::disk('public')->delete($path);
            }

            $heroImages = [];

            foreach ($request->file('hero_images', []) as $image) {
                $heroImages[] = $image->store('settings/hero', 'public');
            }

            $data['hero_images'] = $heroImages;
        }

        if ($request->boolean('remove_hero_video_file') && $settings->hero_video_file_path) {
            Storage::disk('public')->delete($settings->hero_video_file_path);
            $data['hero_video_file_path'] = null;
        }

        if ($request->hasFile('hero_video_file')) {
            if ($settings->hero_video_file_path) {
                Storage::disk('public')->delete($settings->hero_video_file_path);
            }

            $data['hero_video_file_path'] = $request->file('hero_video_file')->store('settings/video', 'public');
        }

        $settings->update($data);

        return redirect()
            ->route('admin.settings.front-office')
            ->with('success', 'Parametrage du front office mis a jour avec succes.');
    }
}
