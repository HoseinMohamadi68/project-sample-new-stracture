<?php

namespace App\Models\User;

use App\Filters\UserFilter;
use App\Interfaces\Models\User\UserInterface;
use App\Models\Language\Language;
use App\Traits\HasApprovedTrait;
use App\Traits\HasCountryIdTrait;
use App\Traits\HasEmailTrait;
use App\Traits\HasIdTrait;
use App\Traits\HasMobileTrait;
use App\Traits\HasFirstNameTrait;
use App\Traits\HasLastNameTrait;
use App\Traits\MagicMethodsTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements UserInterface
{
    use HasFactory;
    use Notifiable;
    use HasApiTokens;
    use HasFirstNameTrait;
    use HasLastNameTrait;
    use MagicMethodsTrait;
    use HasEmailTrait;
    use HasMobileTrait;
    use HasApprovedTrait;
    use HasIdTrait;
    use Notifiable;
    use HasCountryIdTrait;

    const TABLE = 'users';
    const ID = 'id';
    const APPROVED = 'approved';
    const MOBILE = 'mobile';
    const FIRST_NAME = 'first_name';
    const LAST_NAME = 'last_name';
    const CHARGE = 'charge';
    const PASSWORD = 'password';
    const PHONE = 'phone';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const LANGUAGE_ID = 'language_id';

    /**
     * Filter scope.
     *
     * @param Builder    $builder Builder.
     * @param UserFilter $filters Filters.
     *
     * @return Builder
     */
    public function scopeFilter(Builder $builder, UserFilter $filters): Builder
    {
        return $filters->apply($builder);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::APPROVED,
        self::FIRST_NAME,
        self::LAST_NAME,
        self::EMAIL,
        self::CHARGE,
        self::PASSWORD,
        self::PHONE
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        self::PASSWORD
    ];

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
    ): UserInterface {
        $user = new static();
        if ($approved !== null) {
            $user->setApproved((bool)$approved);
        }
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setMobile($mobile);
        if ($password) {
            $user->setPassword(Hash::make($password));
        }
        $user->setEmail($email);
        if (!is_null($charge)) {
            $user->setCharge($charge);
        }
        $user->setPhone($phone);
        $user->save();

        return $user;
    }

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
    ): UserInterface {
        $this->setApproved((bool)$approved);
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setMobile($mobile);
        if ($password) {
            $this->setPassword(Hash::make($password));
        }
        $this->setEmail($email);
        if (!is_null($charge)) {
            $this->setCharge($charge);
        }
        $this->setPhone($phone);
        $this->save();

        return $this;
    }

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * User has permission.
     *
     * @param string $permission Permission title.
     *
     * @return boolean
     */
    public function hasPermission(string $permission): bool
    {
        return !empty(static::whereIdIn([$this->getId()])->whereHasPermission($permission)->first());
    }

    /**
     * @param Builder $builder    Builder.
     * @param string  $permission Permission title.
     *
     * @return Builder
     */
    public function scopeWhereHasPermission(Builder $builder, string $permission): Builder
    {
        return $builder->whereHas('roles', function (Builder $joinRole) use ($permission) {
            return $joinRole->whereHas('permissions', function (Builder $joinPermission) use ($permission) {
                return $joinPermission->whereTitleIs($permission);
            });
        });
    }

    /**
     * @return HasMany
     */
    public function firebaseTokens(): HasMany
    {
        return $this->hasMany(Token::class);
    }

    /**
     * Specifies the user's FCM token
     *
     * @return string|array
     */
    public function routeNotificationForFcm()
    {
        /* multi device */
        return $this->firebaseTokens->pluck('firebase_token');

        /* Singular */
        //$this->fcm_token = 'e6b4ypN9Vt-ZVOfNgp1jxU:APA91bF78l6QEp4Te5o2midUehfAiFbr-Vi1sgEv5vTmNZitEhqVfjUHykAH18QZXKqCHbAIB_mVvSALS43hrra2WdaQo64p02MEBhShSLm_TRdv0zLfwTWKpv0SAuxIHkN0Hg55IA4G';
        //return $this->fcm_token;
    }

    /**
     * @param Builder $builder Builder.
     * @param string  $slug    Slug.
     *
     * @return Builder
     */
    public function scopeWhereRoleSlugIs(Builder $builder, string $slug): Builder
    {
        return $builder->whereHas(
            'roles',
            function (Builder $join) use ($slug) {
                return $join->whereSlugIs($slug);
            }
        );
    }

    /**
     * @param Builder $builder   Builder.
     * @param integer $companyId Company ID.
     *
     * @return Builder
     */
    public function scopeWhereCompanyIdIs(Builder $builder, int $companyId): Builder
    {
        return $builder->whereHas(
            'companyUsers',
            function (Builder $joinCompanyUser) use ($companyId) {
                return $joinCompanyUser->whereCompanyIdIs($companyId);
            }
        );
    }

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
    ): Builder {
        return $builder->whereHasPermission($permission)
            ->whereHas(
                'companyUsers',
                function (Builder $joinCompanyUser) use ($provinceId) {
                    return $joinCompanyUser->whereCompanyHasLicenseForProvince($provinceId);
                }
            );
    }

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
    ): Builder {
        return $builder->whereHasPermission($permission)
            ->whereHas(
                'companyUsers',
                function (Builder $joinCompanyUser) use ($ownerId, $provinceId) {
                    return $joinCompanyUser->whereHasAvailableCompanyContractForOwner(
                        $ownerId,
                        $provinceId
                    );
                }
            );
    }

    /**
     * @return BelongsTo
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
