<?php

namespace App\Traits;

use App\Models\SaleSystem\SaleSystem;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait BelongsToManySaleSystemTrait
{
    /**
     * @return BelongsToMany
     */
    public function saleSystems(): BelongsToMany
    {
        return $this->belongsToMany(SaleSystem::class);
    }
}
