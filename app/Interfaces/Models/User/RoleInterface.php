<?php

namespace App\Interfaces\Models\User;

use App\Filters\RoleFilter;
use App\Interfaces\Models\BaseModelInterface;
use App\Interfaces\Traits\HasCompanyVisibilityInterface;
use App\Interfaces\Traits\HasOwnerVisibilityInterface;
use App\Interfaces\Traits\HasTitleInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface RoleInterface extends
    BaseModelInterface,
    HasCompanyVisibilityInterface,
    HasOwnerVisibilityInterface
{
    const TABLE = 'roles';

    const COMPANY_VISIBILITY = 'company_visibility';
    const OWNER_VISIBILITY = 'owner_visibility';
    const ADMIN_ROLE = 'admin';
    const USER_ROLE = 'user';

    /**
     * Filter scope.
     *
     * @param Builder    $builder Builder.
     * @param RoleFilter $filters Filters.
     *
     * @return Builder
     */
    public function scopeFilter(Builder $builder, RoleFilter $filters): Builder;

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany;

    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany;

    /**
     * @param boolean|null $ownerVisibility   OwnerVisibility.
     * @param boolean|null $companyVisibility CompanyVisibility.
     * @return RoleInterface
     */
    public static function createObject(
        ?bool $ownerVisibility = false,
        ?bool $companyVisibility = false
    ): RoleInterface;

    /**
     * @param boolean|null $ownerVisibility   OwnerVisibility.
     * @param boolean|null $companyVisibility CompanyVisibility.
     * @return RoleInterface
     */
    public function updateObject(
        ?bool $ownerVisibility = false,
        ?bool $companyVisibility = false
    ): RoleInterface;
}
