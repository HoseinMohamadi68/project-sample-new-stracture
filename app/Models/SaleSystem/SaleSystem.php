<?php

namespace App\Models\SaleSystem;

use App\Filters\SaleSystem\SaleSystemFilter;
use App\Interfaces\Models\SaleSystem\SaleSystemInterface;
use App\Models\LocalizableModel;
use App\Models\Translations\SaleSystemTranslation;
use App\Traits\BelongsToManyPaymentMethodTypeTrait;
use App\Traits\HasBtobTrait;
use App\Traits\HasBtocTrait;
use App\Traits\HasDeliveryTrait;
use App\Traits\HasDomainTrait;
use App\Traits\HasFaxTrait;
use App\Traits\HasIdTrait;
use App\Traits\HasIsActiveTrait;
use App\Traits\HasMaxClientRootTrait;
use App\Traits\HasNetworkTrait;
use App\Traits\HasPhoneTrait;
use App\Traits\HasRegisterNumberTrait;
use App\Traits\HasRegisterOfficeTrait;
use App\Traits\HasUserIdTrait;
use App\Traits\HasWarehouseTrait;
use App\Traits\HasWarrantyDaysTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleSystem extends LocalizableModel implements SaleSystemInterface
{
    use HasFactory;
    use HasIdTrait;
    use HasUserIdTrait;
    use HasRegisterNumberTrait;
    use HasRegisterOfficeTrait;
    use HasDomainTrait;
    use HasPhoneTrait;
    use HasFaxTrait;
    use HasNetworkTrait;
    use HasBtobTrait;
    use HasBtocTrait;
    use HasWarehouseTrait;
    use HasDeliveryTrait;
    use HasWarrantyDaysTrait;
    use HasMaxClientRootTrait;
    use HasIsActiveTrait;
    use BelongsToManyPaymentMethodTypeTrait;

    /**
     * @var string[]
     */
    protected $guarded = [
        self::ID
    ];

    /**
     * @var array
     */
    protected array $localizable = [
        SaleSystemTranslation::NAME,
        SaleSystemTranslation::DESCRIPTION,
    ];

    /**
     * Filter scope.
     *
     * @param Builder          $builder Builder.
     * @param SaleSystemFilter $filters Filters.
     *
     * @return Builder
     */
    public function scopeFilter(Builder $builder, SaleSystemFilter $filters): Builder
    {
        return $filters->apply($builder);
    }

    /**
     * Create new Object.
     *
     * @param array $attributes Attributes columns.
     *
     * @return SaleSystemInterface
     */
    public static function createObject(array $attributes): SaleSystemInterface
    {
        return self::create($attributes);
    }

    /**
     * Update an Object.
     *
     * @param array $attributes Attributes columns.
     *
     * @return SaleSystemInterface
     */
    public function updateObject(array $attributes): SaleSystemInterface
    {
        $this->update($attributes);

        return $this;
    }
}
