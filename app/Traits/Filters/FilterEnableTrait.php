<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterEnableTrait
{
    /**
     * Filter enable files.
     *
     * @param string|boolean $enable Enable or not.
     *
     * @return Builder
     */
    protected function enable($enable): Builder // phpcs:ignore
    {
        if (!is_bool($enable)) {
            $enable = $enable === 'true';
        }

        if ($enable) {
            return $this->builder->whereEnabled();
        }

        return $this->builder->whereNotEnabled();
    }
}
