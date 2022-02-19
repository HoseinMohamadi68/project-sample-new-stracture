<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface BelongsToManyLanguagesInterface
{
    /**
     * @return BelongsToMany
     */
    public function languages(): BelongsToMany;
}
