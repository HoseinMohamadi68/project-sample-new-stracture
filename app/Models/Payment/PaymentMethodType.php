<?php

namespace App\Models\Payment;

use App\Filters\Payment\PaymentMethodTypeFilter;
use App\Interfaces\Models\Payment\PaymentMethodTypeInterface;
use App\Models\BaseModel;
use App\Traits\BelongsToManySaleSystemTrait;
use App\Traits\HasTitleTrait;
use Illuminate\Database\Eloquent\Builder;

class PaymentMethodType extends BaseModel implements PaymentMethodTypeInterface
{
    use HasTitleTrait;
    use BelongsToManySaleSystemTrait;

    /**
     * @var boolean
     */
    public $timestamps = false;

    /**
     *
     * @var string[]
     */
    protected $fillable = [
        self::TITLE
    ];

    /**
     * Filter scope.
     *
     * @param Builder                 $builder Builder.
     * @param PaymentMethodTypeFilter $filters Filters.
     *
     * @return Builder
     */
    public function scopeFilter(Builder $builder, PaymentMethodTypeFilter $filters): Builder
    {
        return $filters->apply($builder);
    }
}
