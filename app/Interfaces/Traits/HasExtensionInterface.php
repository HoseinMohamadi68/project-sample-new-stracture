<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasExtensionInterface
{
    /**
     * @param Builder $builder   Builder.
     * @param string  $extension Extension.
     *
     * @return Builder
     */
    public function scopeWhereExtensionIs(Builder $builder, string $extension): Builder;
}
