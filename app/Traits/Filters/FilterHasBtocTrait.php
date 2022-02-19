<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterHasBtocTrait
{
    /**
     * @param boolean $hasBtoc Has Btoc.
     * @return Builder
     */
    public function hasBtoc($hasBtoc): Builder // phpcs:ignore
    {
        if (is_string($hasBtoc)) {
            $hasBtoc = $hasBtoc === 'true';
        }
        if ($hasBtoc) {
            return $this->builder->whereHasBtoc();
        }

        return $this->builder->whereHasNotBtoc();
    }
}
