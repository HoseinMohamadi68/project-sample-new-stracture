<?php

namespace App\Interfaces\Traits;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface HasCoachIdInterface
{
    /**
     * @param Builder $builder  Builder.
     * @param array   $coachIds IDs.
     *
     * @return Builder
     */
    public function scopeWhereCoachIdIn(Builder $builder, array $coachIds): Builder;

    /**
     * @return BelongsTo
     */
    public function coach(): BelongsTo;
}
