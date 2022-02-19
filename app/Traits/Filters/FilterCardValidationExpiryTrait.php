<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterCardValidationExpiryTrait
{
    /**
     * Filter by CardValidationExpiry.
     *
     * @param string $cardValidationExpiry CardValidationExpiry.
     *
     * @return Builder
     */
    protected function cardValidationExpiry(string $cardValidationExpiry): Builder
    {
        return $this->builder->whereCardValidationExpiryIs($cardValidationExpiry);
    }

    /**
     * Filter by Freather Than CardValidationExpiry.
     *
     * @param string $cardValidationExpiry CardValidationExpiry.
     *
     * @return Builder
     */
    public function cardValidationExpiryGreaterThan(string $cardValidationExpiry): Builder
    {
        return $this->builder->whereCardValidationExpiryGreaterThan($cardValidationExpiry);
    }

    /**
     * Filter by Less Than CardValidationExpiry.
     *
     * @param string $cardValidationExpiry CardValidationExpiry.
     *
     * @return Builder
     */
    public function cardValidationExpiryLessThan(string $cardValidationExpiry): Builder
    {
        return $this->builder->whereCardValidationExpiryLessThan($cardValidationExpiry);
    }
}
