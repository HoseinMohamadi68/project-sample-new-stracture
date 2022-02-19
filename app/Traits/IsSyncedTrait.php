<?php

namespace App\Traits;

use App\Interfaces\Traits\IsSyncedInterface;
use Illuminate\Database\Eloquent\Builder;

trait IsSyncedTrait
{
    /**
     * Is synced.
     *
     * @return boolean
     */
    public function isSynced(): bool
    {
        return !empty($this->{self::SYNCED});
    }

    /**
     * Set synced.
     *
     * @return IsSyncedInterface
     */
    public function sync(): IsSyncedInterface
    {
        $this->{self::SYNCED} = true;

        return $this;
    }

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereSynced(Builder $builder): Builder
    {
        return $builder->where(self::SYNCED, true);
    }

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereNotSynced(Builder $builder): Builder
    {
        return $builder->whereNull(self::SYNCED);
    }
}
