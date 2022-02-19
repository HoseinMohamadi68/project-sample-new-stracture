<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterIsActiveTrait
{
    /**
     * @param boolean $active Is Active.
     *
     * @return Builder
     */
    public function active($active): Builder // phpcs:ignore
    {
        if (is_string($active)) {
            $active = $active === 'true';
        }
        if ($active) {
            return $this->builder->whereActive();
        }

        return $this->builder->whereNotActive();
    }
}
