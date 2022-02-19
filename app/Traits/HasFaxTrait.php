<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasFaxTrait
{
    /**
     * @param Builder $builder Builder.
     * @param string  $fax     Domain.
     *
     * @return Builder
     */
    public function scopeWhereFaxLike(Builder $builder, string $fax): Builder
    {
        return $builder->where(self::FAX, 'like', "%$fax%");
    }
}
