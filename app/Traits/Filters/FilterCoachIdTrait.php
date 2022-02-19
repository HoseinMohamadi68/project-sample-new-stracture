<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterCoachIdTrait
{
    /**
     * Filter by Coach Id.
     *
     * @param integer $coachId Coach Id.
     *
     * @return Builder
     */
    protected function coachId(int $coachId): Builder
    {
        return $this->builder->whereCoachId($coachId);
    }

    /**
     * Filter by Coach Ids.
     *
     * @param array $coachIds Coach Ids.
     *
     * @return Builder
     */
    protected function coachIds(array $coachIds): Builder
    {
        return $this->builder->whereCoachIdIn($coachIds);
    }
}
