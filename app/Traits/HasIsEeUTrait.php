<?php

namespace App\Traits;

use App\Interfaces\Traits\HasIsActiveInterface;
use App\Interfaces\Traits\HasIsEeuInterface;
use Illuminate\Database\Eloquent\Builder;

trait HasIsEeUTrait
{
    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereEeu(Builder $builder): Builder
    {
        return $builder->where(self::IS_EEU, true);
    }

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereNotEeu(Builder $builder): Builder
    {
        return $builder->where(self::IS_EEU, false);
    }

    /**
     * @return HasIsEeuInterface
     */
    public function eeu(): HasIsEeuInterface
    {
        $this->setIsEeu(true);
        $this->save();

        return $this;
    }

    /**
     * @return HasIsEeuInterface
     */
    public function notEeu(): HasIsEeuInterface
    {
        $this->setIsEeu(false);
        $this->save();

        return $this;
    }
}
