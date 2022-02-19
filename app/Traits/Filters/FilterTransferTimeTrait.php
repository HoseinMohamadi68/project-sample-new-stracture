<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterTransferTimeTrait
{
    /**
     * Filter by Transfer Time At.
     *
     * @param string $transferTime Transfer Time At.
     *
     * @return Builder
     */
    protected function transferTime(string $transferTime): Builder
    {
        return $this->builder->whereTransferTimeIs($transferTime);
    }

    /**
     * Filter by Transfer Time At.
     *
     * @param string $transferTime Transfer Time At.
     *
     * @return Builder
     */
    public function transferTimeGreaterThan(string $transferTime): Builder
    {
        return $this->builder->whereTransferTimeGreaterThan($transferTime);
    }

    /**
     * Filter by Transfer Time At.
     *
     * @param string $transferTime Transfer Time At.
     *
     * @return Builder
     */
    public function transferTimeLessThan(string $transferTime): Builder
    {
        return $this->builder->whereTransferTimeLessThan($transferTime);
    }
}
