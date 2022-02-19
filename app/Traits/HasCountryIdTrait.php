<?php

namespace App\Traits;

use App\Models\Country\Country;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasCountryIdTrait
{
    /**
     * @param Builder $builder    Builder.
     * @param array   $countryIds IDs.
     *
     * @return Builder
     */
    public function scopeWhereCountryIdIn(Builder $builder, array $countryIds): Builder
    {
        return $builder->whereIn(self::COUNTRY_ID, $countryIds);
    }

    /**
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
