<?php

namespace App\Models\Price;

use App\Filters\Price\PriceTypeFilter;
use App\Interfaces\Models\Perice\PriceTypeInterface;
use App\Models\LocalizableModel;
use App\Models\Translations\PriceTypeTranslation;
use App\Traits\HasIdTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PriceType extends LocalizableModel implements PriceTypeInterface
{
    use HasFactory;
    use HasIdTrait;

    /**
     * @var string[]
     */
    protected $fillable = [self::ID];

    /**
     * @var array
     */
    protected array $localizable = [
        PriceTypeTranslation::NAME
    ];

    /**
     * @param Builder         $builder Builder.
     * @param PriceTypeFilter $filters Filters.
     *
     * @return Builder
     */
    public function scopeFilter(Builder $builder, PriceTypeFilter $filters): Builder
    {
        return $filters->apply($builder);
    }

    /**
     * @return PriceTypeInterface
     */
    public static function createObject(): PriceTypeInterface
    {
        $priceType = new static();
        $priceType->save();

        return $priceType;
    }

    /**
     * @return PriceTypeInterface
     */
    public function updateObject(): PriceTypeInterface
    {
        $this->save();

        return $this;
    }
}
