<?php

namespace App\Models\User;

use App\Filters\RoleFilter;
use App\Models\Translations\RoleTranslation;
use App\Interfaces\Models\User\RoleInterface;
use App\Models\LocalizableModel;
use App\Traits\HasCompanyVisibilityTrait;
use App\Traits\HasOwnerVisibilityTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends LocalizableModel implements RoleInterface
{
    use HasCompanyVisibilityTrait;
    use HasOwnerVisibilityTrait;

    /**
     * @var string[]
     */
    public static array $customRoles = [
        self::ADMIN_ROLE,
        self::USER_ROLE,
    ];

    /**
     * @var array
     */
    protected array $localizable = [
        RoleTranslation::TITLE
    ];

    /**
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Filter scope.
     *
     * @param Builder    $builder Builder.
     * @param RoleFilter $filters Filters.
     *
     * @return Builder
     */
    public function scopeFilter(Builder $builder, RoleFilter $filters): Builder
    {
        return $filters->apply($builder);
    }

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * @param boolean|null $ownerVisibility   OwnerVisibility.
     * @param boolean|null $companyVisibility CompanyVisibility.
     * @return RoleInterface
     */
    public static function createObject(
        ?bool $ownerVisibility = false,
        ?bool $companyVisibility = false
    ): RoleInterface {
        $role = new static();
        $role->setCompanyVisibility($companyVisibility);
        $role->setOwnerVisibility($ownerVisibility);
        $role->save();

        return $role;
    }

    /**
     * @param boolean|null $ownerVisibility   OwnerVisibility.
     * @param boolean|null $companyVisibility CompanyVisibility.
     * @return RoleInterface
     */
    public function updateObject(
        ?bool $ownerVisibility = false,
        ?bool $companyVisibility = false
    ): RoleInterface {
        $this->setCompanyVisibility($companyVisibility);
        $this->setOwnerVisibility($ownerVisibility);
        $this->save();

        return $this;
    }
}
