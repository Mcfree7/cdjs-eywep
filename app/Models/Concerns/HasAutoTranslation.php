<?php

namespace App\Models\Concerns;

use App\Observers\AutoTranslateObserver;

trait HasAutoTranslation
{
    public static function bootHasAutoTranslation(): void
    {
        static::observe(AutoTranslateObserver::class);
    }

    public function translatableFields(): array
    {
        return $this->translatable ?? [];
    }

    public function translated(string $field): ?string
    {
        $value = $this->{$field} ?? null;

        if ($value === null || $value === '') {
            return null;
        }

        $locale = app()->getLocale();

        if ($locale === 'fr') {
            return $value;
        }

        $translated = $this->{"{$field}_{$locale}"} ?? null;

        return $translated !== null && $translated !== '' ? $translated : $value;
    }
}
