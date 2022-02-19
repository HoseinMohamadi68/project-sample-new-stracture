<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasMimeTypeTrait
{
    /**
     * @param Builder $builder Builder.
     * @param string  $type    Type.
     *
     * @return Builder
     */
    public function scopeWhereMimeTypeIs(Builder $builder, string $type): Builder
    {
        return $builder->where(self::MIME_TYPE, $type);
    }
}
