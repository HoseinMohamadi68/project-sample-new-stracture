<?php

namespace App\Traits\Filters;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

trait FilterFullName
{
    /**
     * @param string $fullName Full Name.
     *
     * @return Builder
     */
    public function fullName(string $fullName): Builder
    {
        $fullName = explode(' ', $fullName);
        foreach ($fullName as $item) {
            $this->builder->where(
                function (Builder $query) use ($item) {
                    $query->orWhereFirstNameLike($item);
                    $query->orWhereLastNameLike($item);
                }
            );
        }

        return $this->builder;
    }

    /**
     * @param string $userFullName Full Name.
     *
     * @return Builder
     */
    public function userFullName(string $userFullName): Builder
    {
        $fullName = explode(' ', $userFullName);
        $userIds = User::where(
            function (Builder $query) use ($fullName) {
                foreach ($fullName as $item) {
                    $query->orWhereFirstNameLike($item);
                    $query->orWhereLastNameLike($item);
                }
            }
        )
            ->pluck('id')
            ->toArray();
        $this->builder->whereHas(
            'user',
            function (Builder $query) use ($userIds) {
                $query->whereIn('user_id', $userIds);
            }
        );

        return $this->builder;
    }
}
