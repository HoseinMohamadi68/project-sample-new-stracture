<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterSpecialWeightTrait
{
    /**
     * Filter by Special Weight.
     *
     * @param integer $specialWeight Special Weight.
     *
     * @return Builder
     */
    protected function specialWeight(int $specialWeight): Builder
    {
        return $this->builder->whereSpecialWeightIs($specialWeight);
    }

    /**
     * Filter by Special Weight.
     *
     * @param integer $specialWeight Special Weight.
     *
     * @return Builder
     */
    protected function specialWeightGreaterThan(int $specialWeight): Builder
    {
        return $this->builder->whereSpecialWeightGreaterThan($specialWeight);
    }

    /**
     * Filter by Special Weight.
     *
     * @param integer $specialWeight Special Weight.
     *
     * @return Builder
     */
    protected function specialWeightLessThan(int $specialWeight): Builder
    {
        return $this->builder->whereSpecialWeightLessThan($specialWeight);
    }
}
