<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasExtensionTrait
{
    /**
     * @param Builder $builder   Builder.
     * @param string  $extension Extension.
     *
     * @return Builder
     */
    public function scopeWhereExtensionIs(Builder $builder, string $extension): Builder
    {
        return $builder->where(self::EXTENSION, $extension);
    }
}
