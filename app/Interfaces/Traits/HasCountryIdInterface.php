<?php

namespace App\Interfaces\Traits;

use App\Models\File\File;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface HasCountryIdInterface
{
    const COUNTRY_ID = 'country_id';
    /**
     * @param Builder $builder    Builder.
     * @param array   $countryIds IDs.
     *
     * @return Builder
     */
    public function scopeWhereCountryIdIn(Builder $builder, array $countryIds): Builder;

    /**
     * @return BelongsTo
     */
    public function country(): BelongsTo;
}
