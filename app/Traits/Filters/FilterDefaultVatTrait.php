<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterDefaultVatTrait
{

    /**
     * Filter By Default vat.
     *
     * @param float $defaultVat Vat.
     *
     * @return Builder
     */
    public function defaultVat(float $defaultVat): Builder
    {
        return $this->builder->whereDefaultVat($defaultVat);
    }

    /**
     * Filter By Default vat.
     *
     * @param float $defaultVat Vat.
     *
     * @return Builder
     */
    public function defaultVatGreaterThan(float $defaultVat): Builder
    {
        return $this->builder->whereDefaultVatGreaterThan($defaultVat);
    }

    /**
     * Filter By Default vat.
     *
     * @param float $defaultVat Vat.
     *
     * @return Builder
     */
    public function defaultVatLessThan(float $defaultVat): Builder
    {
        return $this->builder->whereDefaultVatLessThan($defaultVat);
    }
}
