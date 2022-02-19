<?php

namespace App\Traits;

use App\Interfaces\Traits\HasIsActiveInterface;
use Illuminate\Database\Eloquent\Builder;

trait HasIsActiveTrait
{
    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereActive(Builder $builder): Builder
    {
        return $builder->where(self::IS_ACTIVE, true);
    }

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereNotActive(Builder $builder): Builder
    {
        return $builder->where(self::IS_ACTIVE, false);
    }

    /**
     * @return HasIsActiveInterface
     */
    public function active(): HasIsActiveInterface
    {
        $this->setIsActive(true);
        $this->save();

        return $this;
    }

    /**
     * @return HasIsActiveInterface
     */
    public function deActive(): HasIsActiveInterface
    {
        $this->setActive(true);
        $this->save();

        return $this;
    }
}
