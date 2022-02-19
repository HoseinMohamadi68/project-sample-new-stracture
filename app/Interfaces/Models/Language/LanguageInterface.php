<?php

namespace App\Interfaces\Models\Language;

use App\Filters\Language\LanguageFilter;
use Illuminate\Database\Eloquent\Builder;

interface LanguageInterface
{
    const TABLE = 'languages';
    const TITLE = 'title';
    const ALPHA2 = 'alpha2';
    const IS_LTR = 'is_ltr';

    /**
     * @param Builder        $builder Builder.
     * @param LanguageFilter $filters Filters.
     *
     * @return Builder
     */
    public function scopeFilter(Builder $builder, LanguageFilter $filters): Builder;

    /**
     * @param boolean $isLtr Is LTR.
     *
     * @return LanguageInterface
     */
    public function updateObject(bool $isLtr): LanguageInterface;
}
