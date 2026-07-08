<?php

namespace App\Observers;

use App\Services\DeepLTranslator;
use Illuminate\Database\Eloquent\Model;

class AutoTranslateObserver
{
    private const TARGET_LANGUAGES = [
        'en' => 'EN-GB',
        'pt' => 'PT-PT',
    ];

    public function __construct(private DeepLTranslator $translator)
    {
    }

    public function saved(Model $model): void
    {
        $fields = method_exists($model, 'translatableFields') ? $model->translatableFields() : [];

        if (empty($fields)) {
            return;
        }

        if (! $model->wasRecentlyCreated && ! $model->wasChanged($fields)) {
            return;
        }

        $updates = [];

        foreach (self::TARGET_LANGUAGES as $suffix => $deeplTarget) {
            foreach ($fields as $field) {
                $value = (string) ($model->{$field} ?? '');

                if ($value === '') {
                    continue;
                }

                $translated = $this->translator->translate($value, $deeplTarget);

                if ($translated !== null) {
                    $updates["{$field}_{$suffix}"] = $translated;
                }
            }
        }

        if (! empty($updates)) {
            $model->updateQuietly($updates);
        }
    }
}
