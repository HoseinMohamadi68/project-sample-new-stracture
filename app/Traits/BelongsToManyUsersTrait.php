<?php

namespace App\Traits;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait BelongsToManyUsersTrait
{
    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
