<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterOriginAddressIdTrait
{
    /**
     * Filter by Origin Address Id.
     *
     * @param integer $originAddressId Origin Address Id.
     *
     * @return Builder
     */
    protected function originAddressId(int $originAddressId): Builder
    {
        return $this->builder->whereOriginAddressIdIs($originAddressId);
    }

    /**
     * Filter by Origin Address Ids.
     *
     * @param array $originAddressIds Origin Address Ids.
     *
     * @return Builder
     */
    protected function originAddressIds(array $originAddressIds): Builder
    {
        return $this->builder->whereOriginAddressIdIn($originAddressIds);
    }
}
