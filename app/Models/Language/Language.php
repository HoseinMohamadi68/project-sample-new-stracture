<?php

namespace App\Models\Language;

use App\Filters\Language\LanguageFilter;
use App\Interfaces\Models\Language\LanguageInterface;
use App\Models\BaseModel;
use App\Traits\HasTitleTrait;
use Illuminate\Database\Eloquent\Builder;

class Language extends BaseModel implements LanguageInterface
{
    use HasTitleTrait;

    /**
     * @var boolean
     */
    public $timestamps = false;

    /**
     * @param Builder        $builder Builder.
     * @param LanguageFilter $filters Filters.
     *
     * @return Builder
     */
    public function scopeFilter(Builder $builder, LanguageFilter $filters): Builder
    {
        return $filters->apply($builder);
    }

    /**
     * @param boolean $isLtr Is LTR.
     *
     * @return LanguageInterface
     */
    public function updateObject(bool $isLtr): LanguageInterface
    {
        $this->setIsLtr($isLtr);
        $this->save();

        return $this;
    }
}
