<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterIsCommuterTrait
{
    /**
     * @param boolean $commuter Is Commuter.
     *
     * @return Builder
     */
    public function commuter($commuter): Builder // phpcs:ignore
    {
        if (is_string($commuter)) {
            $commuter = $commuter === 'true';
        }
        if ($commuter) {
            return $this->builder->whereCommuter();
        }

        return $this->builder->whereNotCommuter();
    }
}
