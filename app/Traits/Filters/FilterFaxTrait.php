<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterFaxTrait
{
    /**
     * @param string $fax Fax.
     *
     * @return Builder
     */
    protected function fax(string $fax): Builder
    {
        return $this->builder->whereFaxLike($fax);
    }
}
