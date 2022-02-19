<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterDefaultWarrantyDaysTrait
{

    /**
     * Filter By Default Warranty Days.
     *
     * @param integer $defaultWarrantyDays Warranty Days.
     *
     * @return Builder
     */
    public function defaultWarrantyDays(int $defaultWarrantyDays): Builder
    {
        return $this->builder->whereDefaultWarrantyDays($defaultWarrantyDays);
    }

    /**
     * Filter By Default Warranty Days.
     *
     * @param integer $defaultWarrantyDays Vat.
     *
     * @return Builder
     */
    public function defaultWarrantyDaysGreaterThan(int $defaultWarrantyDays): Builder
    {
        return $this->builder->whereDefaultWarrantyDaysGreaterThan($defaultWarrantyDays);
    }

    /**
     * Filter By Default Warranty Days.
     *
     * @param integer $defaultWarrantyDays Vat.
     *
     * @return Builder
     */
    public function defaultWarrantyDaysLessThan(int $defaultWarrantyDays): Builder
    {
        return $this->builder->whereDefaultWarrantyDaysLessThan($defaultWarrantyDays);
    }
}
