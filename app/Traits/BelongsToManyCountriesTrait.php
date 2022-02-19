<?php

namespace App\Traits;

use App\Models\Country\Country;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait BelongsToManyCountriesTrait
{
    /**
     * @return BelongsToMany
     */
    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class);
    }
}
