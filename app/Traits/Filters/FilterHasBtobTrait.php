<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterHasBtobTrait
{
    /**
     * @param boolean $hasBtob Has Btob.
     * @return Builder
     */
    public function hasBtob($hasBtob): Builder // phpcs:ignore
    {
        if (is_string($hasBtob)) {
            $hasBtob = $hasBtob === 'true';
        }
        if ($hasBtob) {
            return $this->builder->whereHasBtob();
        }

        return $this->builder->whereHasNotBtob();
    }
}
