<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterCountableTrait
{
    /**
     * @param boolean $countable Countable.
     *
     * @return Builder
     */
    public function countable($countable): Builder // phpcs:ignore
    {
        if (is_string($countable)) {
            $countable = $countable === 'true';
        }
        if ($countable) {
            return $this->builder->whereCountable();
        }

        return $this->builder->whereNotCountable();
    }
}
