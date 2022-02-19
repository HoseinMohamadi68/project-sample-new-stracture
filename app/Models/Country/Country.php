<?php

namespace App\Models\Country;

use App\Filters\Country\CountryFilter;
use App\Interfaces\Models\Country\CountryInterface;
use App\Models\LocalizableModel;
use App\Models\Translations\CountryTranslation;
use App\Traits\BelongsToManyLanguagesTrait;
use App\Traits\HasCurrencyIdTrait;
use App\Traits\HasDefaultVatTrait;
use App\Traits\HasDefaultWarrantyDaysTrait;
use App\Traits\HasIdTrait;
use App\Traits\HasIsEeUTrait;
use App\Traits\HasIso2Trait;
use App\Traits\HasIso3Trait;
use App\Traits\HasMaxSmallBusinessTradeTrait;
use App\Traits\HasMaxTaxFreeTradeTrait;
use Illuminate\Database\Eloquent\Builder;

class Country extends LocalizableModel implements CountryInterface
{
    use HasIdTrait;
    use HasCurrencyIdTrait;
    use HasDefaultVatTrait;
    use HasDefaultWarrantyDaysTrait;
    use HasIsEeUTrait;
    use HasMaxTaxFreeTradeTrait;
    use HasMaxSmallBusinessTradeTrait;
    use HasIso2Trait;
    use HasIso3Trait;
    use BelongsToManyLanguagesTrait;


    /**
     *
     * @var string[]
     */
    protected $fillable = [
        self::CURRENCY_ID,
        self::DEFAULT_VAT,
        self::DEFAULT_WARRANTY_DAYS,
        self::IS_EEU,
        self::MAX_TAX_FREE_TRADE,
        self::MAX_SMALL_BUSINESS_TRADE,
        self::ISO2,
        self::ISO3,
    ];

    /**
     * @var array
     */
    protected array $localizable = [
        CountryTranslation::NAME
    ];

    /**
     * Filter scope.
     *
     * @param Builder       $builder Builder.
     * @param CountryFilter $filters Filters.
     *
     * @return Builder
     */
    public function scopeFilter(Builder $builder, CountryFilter $filters): Builder
    {
        return $filters->apply($builder);
    }

    /**
     * Create new Object.
     *
     * @param array $attributes Attribute to create an Entity.
     * @return CountryInterface
     */
    public static function createObject(array $attributes): CountryInterface
    {
        return self::create($attributes);
    }

    /**
     * Update an Object.
     *
     * @param array $attributes Attribute to update an Entity.
     * @return CountryInterface
     */
    public function updateObject(array $attributes): CountryInterface
    {
        $this->update($attributes);

        return $this;
    }
}
