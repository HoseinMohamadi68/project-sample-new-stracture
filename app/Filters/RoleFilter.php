<?php

namespace App\Filters;

use App\Traits\Filters\FilterCompanyVisibilityTrait;
use App\Traits\Filters\FilterIdsTrait;
use App\Traits\Filters\FilterOwnerVisibilityTrait;
use Illuminate\Database\Eloquent\Builder;

class RoleFilter extends Filters
{
    use FilterIdsTrait;
    use FilterCompanyVisibilityTrait;
    use FilterOwnerVisibilityTrait;

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected array $filters = [
        'title',
        'ids',
        'companyVisibility',
        'ownerVisibility',
    ];

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected array $attributes = [
        'title' => 'string',
        'ids' => 'array',
        'companyVisibility' => 'boolean',
        'ownerVisibility' => 'boolean',
    ];

    /**
     * @param string $title Title.
     * @return Builder
     */
    public function title(string $title): Builder
    {
        return $this->builder->whereHas('translations', function ($query) use ($title) {
            return $query->whereTitleLike($title);
        });
    }
}
