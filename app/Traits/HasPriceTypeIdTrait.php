<?php

namespace App\Traits;

use App\Models\Price\PriceType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasPriceTypeIdTrait
{

    /**
     * @param Builder $builder     Builder.
     * @param integer $priceTypeId PriceType.
     *
     * @return Builder
     */
    public function scopeWherePriceTypeIdIs(Builder $builder, int $priceTypeId): Builder
    {
        return $builder->where(self::PRICE_TYPE_ID, $priceTypeId);
    }

    /**
     * @param Builder $builder     Builder.
     * @param integer $priceTypeId PriceType.
     *
     * @return Builder
     */
    public function scopeOrWherePriceTypeIdIs(Builder $builder, int $priceTypeId): Builder
    {
        return $builder->orWhere(self::PRICE_TYPE_ID, $priceTypeId);
    }

    /**
     * @param Builder $builder     Builder.
     * @param array   $priceTypeId PriceType.
     *
     * @return Builder
     */
    public function scopeWherePriceTypeIdIn(Builder $builder, array $priceTypeId): Builder
    {
        return $builder->whereIn(self::PRICE_TYPE_ID, $priceTypeId);
    }

    /**
     * @return BelongsTo
     */
    public function network(): BelongsTo
    {
        return $this->belongsTo(PriceType::class);
    }
}
