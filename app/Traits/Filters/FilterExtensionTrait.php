<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterExtensionTrait
{
    /**
     * Filter by extension.
     *
     * @param string $extension Extension.
     *
     * @return Builder
     */
    protected function extension(string $extension): Builder
    {
        return $this->builder->whereExtensionIs($extension);
    }
}
