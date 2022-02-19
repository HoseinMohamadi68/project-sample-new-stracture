<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterReferencableTrait
{
    /**
     * @param string $referencableType Referencable Type.
     *
     * @return Builder
     */
    public function referencableType(string $referencableType): Builder
    {
        return $this->builder->whereReferencableTypeIs($referencableType);
    }

    /**
     * @param integer $referencableId Referencable ID.
     *
     * @return Builder
     */
    public function referencableId(int $referencableId): Builder
    {
        return $this->builder->whereReferencableIdIs($referencableId);
    }
}
