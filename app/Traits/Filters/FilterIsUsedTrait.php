<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterIsUsedTrait
{
    /**
     * @param boolean $isUsed Is Used.
     * @return Builder
     */
    public function used(bool $isUsed): Builder
    {
        if ($isUsed) {
            return $this->builder->whereUsed();
        }

        return $this->builder->whereNotUsed();
    }
}
