<?php

namespace App\Traits;

use App\Models\User\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasRoleIdTrait
{
    /**
     * @param Builder $builder Builder.
     * @param integer $roleId  ID.
     *
     * @return Builder
     */
    public function scopeWhereRoleIdIs(Builder $builder, int $roleId): Builder
    {
        return $builder->where(self::ROLE_ID, $roleId);
    }

    /**
     * @param Builder $builder Builder.
     * @param integer $roleId  ID.
     *
     * @return Builder
     */
    public function scopeOrWhereRoleIdIs(Builder $builder, int $roleId): Builder
    {
        return $builder->orWhere(self::ROLE_ID, $roleId);
    }

    /**
     * @param Builder $builder Builder.
     * @param array   $roleIds IDs.
     *
     * @return Builder
     */
    public function scopeWhereRoleIdIn(Builder $builder, array $roleIds): Builder
    {
        return $builder->whereIn(self::ROLE_ID, $roleIds);
    }

    /**
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
