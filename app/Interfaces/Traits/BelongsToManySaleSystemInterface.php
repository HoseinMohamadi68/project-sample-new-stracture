<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface BelongsToManySaleSystemInterface
{
    /**
     * @return BelongsToMany
     */
    public function saleSystems(): BelongsToMany;
}
