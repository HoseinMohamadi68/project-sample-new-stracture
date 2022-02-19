<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface BelongsToManyUsersInterface
{
    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany;
}
