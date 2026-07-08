<?php

namespace App\Console\Commands;

use App\Models\Activity;
use App\Models\Article;
use App\Models\Faq;
use App\Models\FrontOfficeSetting;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Project;
use App\Models\ResourceItem;
use App\Models\SuccessStory;
use App\Services\DeepLTranslator;
use Illuminate\Console\Command;

class BackfillTranslations extends Command
{
    protected $signature = 'translations:backfill';

    protected $description = "Traduit automatiquement les enregistrements existants qui n'ont pas encore de traduction EN/PT";

    private const TARGET_LANGUAGES = [
        'en' => 'EN-GB',
        'pt' => 'PT-PT',
    ];

    private const MODELS = [
        Article::class,
        Activity::class,
        Project::class,
        Gallery::class,
        ResourceItem::class,
        SuccessStory::class,
        News::class,
        Faq::class,
        FrontOfficeSetting::class,
    ];

    public function handle(DeepLTranslator $translator): int
    {
        foreach (self::MODELS as $modelClass) {
            $fields = (new $modelClass())->translatableFields();

            if (empty($fields)) {
                continue;
            }

            $this->info("Traitement de {$modelClass}...");

            $modelClass::query()->chunkById(50, function ($records) use ($translator, $fields) {
                foreach ($records as $record) {
                    $updates = [];

                    foreach (self::TARGET_LANGUAGES as $suffix => $deeplTarget) {
                        foreach ($fields as $field) {
                            $targetColumn = "{$field}_{$suffix}";
                            $existing = $record->{$targetColumn} ?? null;

                            if ($existing !== null && $existing !== '') {
                                continue;
                            }

                            $value = (string) ($record->{$field} ?? '');

                            if ($value === '') {
                                continue;
                            }

                            $translated = $translator->translate($value, $deeplTarget);

                            if ($translated !== null) {
                                $updates[$targetColumn] = $translated;
                            }
                        }
                    }

                    if (! empty($updates)) {
                        $record->updateQuietly($updates);
                        $this->line("  -> {$record->getTable()}#{$record->id} traduit");
                    }
                }
            });
        }

        $this->info('Rattrapage des traductions termine.');

        return self::SUCCESS;
    }
}
