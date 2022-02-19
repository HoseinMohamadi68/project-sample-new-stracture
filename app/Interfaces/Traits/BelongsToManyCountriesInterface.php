<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface BelongsToManyCountriesInterface
{
    /**
     * @return BelongsToMany
     */
    public function countries(): BelongsToMany;
}
