<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasTypeInterface
{
    const TYPE = 'type';
    const FAX = 'fax';
    const MOBILE = 'mobile';
    const PHONE = 'phone';

    /**
     * @param Builder $builder Builder.
     * @param string  $type    Type.
     *
     * @return Builder
     */
    public function scopeWhereTypeIs(Builder $builder, string $type): Builder;

    /**
     * @param Builder $builder Builder.
     * @param string  $type    Type.
     *
     * @return Builder
     */
    public function scopeOrWhereTypeIs(Builder $builder, string $type): Builder;
}
