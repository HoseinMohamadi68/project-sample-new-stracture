<?php

namespace App\Interfaces\Models\User;

use App\Filters\UserFilter;
use App\Interfaces\Traits\HasApprovedInterface;
use App\Interfaces\Traits\HasCountryIdInterface;
use App\Interfaces\Traits\HasEmailInterface;
use App\Interfaces\Traits\HasFirstNameInterface;
use App\Interfaces\Traits\HasIdInterface;
use App\Interfaces\Traits\HasLastNameInterface;
use App\Interfaces\Traits\HasMobileInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

interface UserInterface extends
    HasCountryIdInterface,
    HasFirstNameInterface,
    HasLastNameInterface,
    HasEmailInterface,
    HasMobileInterface,
    HasApprovedInterface,
    HasIdInterface
{
    /**
     * Filter scope.
     *
     * @param Builder    $builder Builder.
     * @param UserFilter $filters Filters.
     *
     * @return Builder
     */
    public function scopeFilter(Builder $builder, UserFilter $filters): Builder;

    /**
     * Create new user.
     *
     * @param string       $mobile    Mobile.
     * @param string|null  $firstName First name.
     * @param string|null  $lastName  Last name.
     * @param boolean|null $approved  The operator must accept the new user.
     * @param string|null  $password  Password.
     * @param string|null  $email     Email.
     * @param string|null  $charge    Charge for using Mobin panel.
     * @param string|null  $phone     Phone Number.
     *
     * @return UserInterface
     */
    public static function createObject(
        string $mobile,
        ?string $firstName = null,
        ?string $lastName = null,
        ?bool $approved = null,
        ?string $password = null,
        ?string $email = null,
        ?string $charge = null,
        ?string $phone = null
    ): UserInterface;

    /**
     * update existing user.
     *
     * @param string       $mobile    Mobile.
     * @param string|null  $firstName FirstName.
     * @param string|null  $lastName  LastName.
     * @param boolean|null $approved  Approved.
     * @param string|null  $password  Password.
     * @param string|null  $email     Email.
     * @param string|null  $charge    Charge.
     * @param string|null  $phone     Phone.
     *
     * @return UserInterface
     */
    public function updateObject(
        string $mobile,
        ?string $firstName = null,
        ?string $lastName = null,
        ?bool $approved = null,
        ?string $password = null,
        ?string $email = null,
        ?string $charge = null,
        ?string $phone = null
    ): UserInterface;

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany;

    /**
     * @param string $permission Permission.
     *
     * @return boolean
     */
    public function hasPermission(string $permission): bool;

    /**
     * @param Builder $builder    Builder.
     * @param string  $permission Permission.
     *
     * @return Builder
     */
    public function scopeWhereHasPermission(Builder $builder, string $permission): Builder;

    /**
     * @return HasMany
     */
    public function firebaseTokens(): HasMany;

    /**
     * Specifies the user's FCM token
     *
     * @return string|array
     */
    public function routeNotificationForFcm();

    /**
     * @param Builder $builder Builder.
     * @param string  $slug    Slug.
     *
     * @return Builder
     */
    public function scopeWhereRoleSlugIs(Builder $builder, string $slug): Builder;

    /**
     * @param Builder $builder   Builder.
     * @param integer $companyId Company ID.
     *
     * @return Builder
     */
    public function scopeWhereCompanyIdIs(Builder $builder, int $companyId): Builder;

    /**
     * @param Builder $builder    Builder.
     * @param string  $permission Permission.
     * @param integer $provinceId Province ID.
     *
     * @return Builder
     */
    public function scopeWhereHasPermissionAndCompanyHasLicenseForProvince(
        Builder $builder,
        string $permission,
        int $provinceId
    ): Builder;

    /**
     * @param Builder $builder    Builder.
     * @param string  $permission Permission.
     * @param integer $ownerId    Owner ID.
     * @param integer $provinceId Province ID.
     *
     * @return Builder
     */
    public function scopeWhereHasAvailableCompanyContractForOwner(
        Builder $builder,
        string $permission,
        int $ownerId,
        int $provinceId
    ): Builder;

    /**
     * @return BelongsTo
     */
//    public function language(): BelongsTo;
}
