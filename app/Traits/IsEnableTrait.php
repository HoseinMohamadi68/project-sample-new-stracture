<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait IsEnableTrait
{
    /**
     * Is enable.
     *
     * @return boolean
     */
    public function isEnable(): bool
    {
        return $this->{self::ENABLED};
    }

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereEnabled(Builder $builder): Builder
    {
        return $builder->where(self::ENABLED, true);
    }

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereNotEnabled(Builder $builder): Builder
    {
        return $builder->where(self::ENABLED, false);
    }
}
