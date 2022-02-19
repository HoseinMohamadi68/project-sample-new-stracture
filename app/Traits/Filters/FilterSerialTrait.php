<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterSerialTrait
{
    /**
     * Filter by Serial.
     *
     * @param integer $serial Serial.
     *
     * @return Builder
     */
    protected function serial(int $serial): Builder
    {
        return $this->builder->whereSerialIs($serial);
    }

    /**
     * Filter by Serial.
     *
     * @param integer $serial Serial.
     *
     * @return Builder
     */
    protected function serialGreaterThan(int $serial): Builder
    {
        return $this->builder->whereSerialGreaterThan($serial);
    }

    /**
     * Filter by Serial.
     *
     * @param integer $serial Serial.
     *
     * @return Builder
     */
    protected function serialLessThan(int $serial): Builder
    {
        return $this->builder->whereSerialLessThan($serial);
    }
}
