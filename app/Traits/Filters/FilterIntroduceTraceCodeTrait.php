<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterIntroduceTraceCodeTrait
{
    /**
     * @param string $introduceTraceCode Introduce Trace Code.
     *
     * @return Builder
     */
    protected function introduceTraceCode(string $introduceTraceCode): Builder
    {
        return $this->builder->whereIntroduceTraceCodeIs($introduceTraceCode);
    }

    /**
     * @param string $introduceTraceCode Introduce Trace Code.
     *
     * @return Builder
     */
    protected function introduceTraceCodeLike(string $introduceTraceCode): Builder
    {
        return $this->builder->whereIntroduceTraceCodeLike($introduceTraceCode);
    }
}
