<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterRootFilesTrait
{
    /**
     * Filter of root files.
     *
     * @param array $rootFiles Root file IDs.
     *
     * @return Builder
     */
    protected function rootFiles(array $rootFiles): Builder
    {
        return $this->builder->whereRootFileIdIn($rootFiles);
    }
}
