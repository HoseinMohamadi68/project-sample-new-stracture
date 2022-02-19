<?php

namespace App\Traits;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasCoachIdTrait
{
    /**
     * @param Builder $builder  Builder.
     * @param array   $coachIds IDs.
     *
     * @return Builder
     */
    public function scopeWhereCoachIdIn(Builder $builder, array $coachIds): Builder
    {
        return $builder->whereIn(self::COACH_ID, $coachIds);
    }

    /**
     * @return BelongsTo
     */
    public function coach(): BelongsTo
    {
        return $this->belongsTo(User::class, self::COACH_ID);
    }
}
