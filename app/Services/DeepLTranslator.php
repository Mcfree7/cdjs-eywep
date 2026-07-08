<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class DeepLTranslator
{
    public function translate(string $text, string $targetLang, string $sourceLang = 'FR'): ?string
    {
        if (trim($text) === '') {
            return null;
        }

        $apiKey = config('services.deepl.key');

        if (! $apiKey) {
            return null;
        }

        try {
            $response = Http::asForm()
                ->withHeaders(['Authorization' => 'DeepL-Auth-Key ' . $apiKey])
                ->timeout(15)
                ->post(rtrim(config('services.deepl.url'), '/') . '/v2/translate', [
                    'text' => $text,
                    'source_lang' => $sourceLang,
                    'target_lang' => $targetLang,
                    'tag_handling' => 'html',
                ]);

            if ($response->failed()) {
                Log::warning('DeepL translation failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return null;
            }

            return $response->json('translations.0.text');
        } catch (Throwable $e) {
            Log::warning('DeepL translation exception: ' . $e->getMessage());

            return null;
        }
    }
}
