<?php

namespace App\Interfaces\Models\User;

use App\Filters\PermissionFilter;
use App\Interfaces\Models\BaseModelInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface PermissionInterface extends BaseModelInterface
{
    /**
     * @param Builder          $builder Builder.
     * @param PermissionFilter $filters Filters.
     *
     * @return Builder
     */
    public function scopeFilter(Builder $builder, PermissionFilter $filters): Builder;

    /**
     * Generate permission title.
     *
     * @param string      $methodName Method name.
     * @param string|null $slug       Slug.
     * @param string|null $related    Related.
     *
     * @return string|null
     */
    public static function generatePermissionTitle(string $methodName, ?string $slug = null, array $related): ?string;

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany;
}
