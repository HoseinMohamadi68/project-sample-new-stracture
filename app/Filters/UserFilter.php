<?php

namespace App\Filters;

use App\Traits\Filters\FilterFullName;
use App\Traits\Filters\FilterIdsTrait;
use Illuminate\Database\Eloquent\Builder;

class UserFilter extends Filters
{
    use FilterIdsTrait;
    use FilterFullName;

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected array $filters = [
        'firstName',
        'lastName',
        'type',
        'email',
        'mobile',
        'approved',
        'ids',
        'fullName',
    ];

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected array $attributes = [
        'firstName' => 'string',
        'lastName' => 'string',
        'type' => 'string',
        'email' => 'string',
        'mobile' => 'string',
        'approved' => 'boolean',
        'ids' => 'array',
        'fullName' => 'string',
    ];

    /**
     * @param integer $companyId Company Id.
     *
     * @return Builder
     */
    public function companyId(int $companyId): Builder
    {
        return $this->builder->whereHas(
            'companies',
            function (Builder $join) use ($companyId) {
                $join->whereCompanyIdIs($companyId);
            }
        );
    }


    /**
     * @param string $firstName FirstName.
     *
     * @return Builder
     */
    protected function firstName(string $firstName): Builder
    {
        return $this->builder->whereFirstNameLike($firstName);
    }

    /**
     * @param string $lastName Last Name.
     *
     * @return Builder
     */
    protected function lastName(string $lastName): Builder
    {
        return $this->builder->whereLastNameLike($lastName);
    }

    /**
     * @param string $type Type.
     *
     * @return Builder
     */
    protected function type(string $type): Builder
    {
        return $this->builder->whereTypeIs($type);
    }

    /**
     * @param string $email Email.
     *
     * @return Builder
     */
    protected function email(string $email): Builder
    {
        return $this->builder->whereEmailLike($email);
    }

    /**
     * @param string $mobile Mobile.
     *
     * @return Builder
     */
    protected function mobile(string $mobile): Builder
    {
        return $this->builder->whereMobileIs($mobile);
    }

    /**
     * @param boolean $approved Approved.
     *
     * @return Builder Builder.
     */
    protected function approved(bool $approved): Builder
    {
        return $this->builder->whereApprovedIs($approved);
    }
}
