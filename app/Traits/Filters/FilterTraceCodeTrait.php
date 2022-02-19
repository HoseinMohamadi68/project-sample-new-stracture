<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterTraceCodeTrait
{
    /**
     * @param string $traceCode Trace Code.
     *
     * @return Builder
     */
    protected function traceCode(string $traceCode): Builder
    {
        return $this->builder->whereTraceCodeIs($traceCode);
    }

    /**
     * @param string $traceCode Trace Code.
     *
     * @return Builder
     */
    protected function traceCodeLike(string $traceCode): Builder
    {
        return $this->builder->whereTraceCodeLike($traceCode);
    }
}
