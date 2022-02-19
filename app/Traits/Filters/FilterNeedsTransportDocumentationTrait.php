<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterNeedsTransportDocumentationTrait
{
    /**
     * @param boolean $needsTransportDocumentation NeedsTransportDocumentation.
     * @return Builder
     */
    public function needsTransportDocumentation($needsTransportDocumentation): Builder // phpcs:ignore
    {
        if (is_string($needsTransportDocumentation)) {
            $needsTransportDocumentation = $needsTransportDocumentation === 'true';
        }
        if ($needsTransportDocumentation) {
            return $this->builder->whereNeedsTransportDocumentation();
        }

        return $this->builder->whereNotNeedsTransportDocumentation();
    }
}
