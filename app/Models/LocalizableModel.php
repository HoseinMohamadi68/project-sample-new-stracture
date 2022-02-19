<?php

namespace App\Models;

use App\Models\User\Role;
use App\Traits\MagicMethodsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

abstract class LocalizableModel extends BaseModel
{
    use HasFactory;
    use MagicMethodsTrait;

    const LOCALIZATION_KEY = 'translate';

    /**
     * Localized attributes
     *
     * @var array
     */
    protected array $localizable = [];

    /**
     * Whether or not to eager load translations
     *
     * @var boolean
     */
    protected bool $eagerLoadTranslations = true;

    /**
     * Whether or not to hide translations
     *
     * @var boolean
     */
    protected bool $hideTranslations = true;

    /**
     * Whether or not to append translatable attributes to array output
     *
     * @var boolean
     */
    protected bool $appendLocalizedAttributes = true;

    /**
     * Make a new translatable model.
     *
     * @param array $attributes Attributes.
     */
    public function __construct(array $attributes = [])
    {
        if ($this->eagerLoadTranslations) {
            $this->with[] = 'translations';
        }
        if ($this->hideTranslations) {
            $this->hidden[] = 'translations';
        }
        // We dynamically append localizable attributes to array output
        if ($this->appendLocalizedAttributes) {
            foreach ($this->localizable as $localizableAttribute) {
                $this->appends[] = $localizableAttribute;
            }
        }
        parent::__construct($attributes);
    }

    /**
     * This model's translations.
     *
     * @return HasMany
     */
    public function translations(): HasMany
    {
        $modelName = class_basename(get_class($this));

        return $this->hasMany("App\\Models\\Translations\\{$modelName}Translation");
    }

    /**
     * Dynamically retrieve attributes on the model.
     *
     * @param  string $key Key.
     * @return mixed
     */
    public function __get($key): mixed // phpcs:ignore
    {
        if (count($this->localizable) and in_array($key, $this->localizable)) {
            /** First check in loaded translations to avoid making extra query */
            $firstItem = $this->translations->where('locale', app()->getLocale())->first();
            if (!empty($firstItem)) {
                return $firstItem->{$key};
            }

            /** If item is empty, we run an extra query to get a value */
            $item = $this->translations()->where('locale', config('app.locale'))->first();

            return optional($item)->{$key} ?? $this->translations->first()->{$key};
        }

        return parent::__get($key);
    }

    /**
     * Handle dynamic method calls into the model.
     *
     * @param  string $method     Method.
     * @param  array  $parameters Parameters.
     * @return mixed
     */
    public function __call($method, $parameters) // phpcs:ignore
    {
        foreach ($this->localizable as $localizableAttribute) {
            if ($method === 'get' . Str::studly($localizableAttribute)) {
                return $this->{$localizableAttribute};
            }
        }

        return parent::__call($method, $parameters);
    }
}
