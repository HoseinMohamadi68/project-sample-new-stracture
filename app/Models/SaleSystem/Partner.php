<?php

namespace App\Models\SaleSystem;

use App\Filters\SaleSystem\PartnerFilter;
use App\Interfaces\Models\SaleSystem\PartnerInterface;
use App\Models\BaseModel;
use App\Traits\HasActiveAutoBonusTrait;
use App\Traits\HasActiveTrainingBonusTrait;
use App\Traits\HasBackIdentityCardIdTrait;
use App\Traits\HasBankNameTrait;
use App\Traits\HasBtobTrait;
use App\Traits\HasBtocTrait;
use App\Traits\HasBusinessCertificationIdTrait;
use App\Traits\HasCanBuyTrait;
use App\Traits\HasCanSeeDownLineTrait;
use App\Traits\HasCoachIdTrait;
use App\Traits\HasCountryIdTrait;
use App\Traits\HasDefaultWarrantyDaysTrait;
use App\Traits\HasDeliveryTrait;
use App\Traits\HasFrontIdentityCardIdTrait;
use App\Traits\HasIbanTrait;
use App\Traits\HasIdTrait;
use App\Traits\HasIsActiveTrait;
use App\Traits\HasMaxClientRootTrait;
use App\Traits\HasMobileTrait;
use App\Traits\HasSaleSystemIdTrait;
use App\Traits\HasNetworkTrait;
use App\Traits\HasOverPersonalTurnoverTrait;
use App\Traits\HasPostDeliveryFactorTrait;
use App\Traits\HasReceiveCommissionTrait;
use App\Traits\HasReceiveVatResponsibleTrait;
use App\Traits\HasSendVatResponsibleTrait;
use App\Traits\HasSwiftTrait;
use App\Traits\HasTransportationRatioPercentageTrait;
use App\Traits\HasUserIdTrait;
use App\Traits\HasWarehouseTrait;
use App\Traits\HasWarrantyDaysTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Kalnoy\Nestedset\NodeTrait;

class Partner extends BaseModel implements PartnerInterface
{
    use NodeTrait;
    use HasFactory;
    use HasIdTrait;
    use HasSaleSystemIdTrait;
    use HasUserIdTrait;
    use HasCoachIdTrait;
    use HasFrontIdentityCardIdTrait;
    use HasBackIdentityCardIdTrait;
    use HasBusinessCertificationIdTrait;
    use HasCountryIdTrait;
    use HasMobileTrait;
    use HasBankNameTrait;
    use HasIbanTrait;
    use HasDefaultWarrantyDaysTrait;
    use HasSwiftTrait;
    use HasReceiveVatResponsibleTrait;
    use HasSendVatResponsibleTrait;
    use HasActiveAutoBonusTrait;
    use HasActiveTrainingBonusTrait;
    use HasPostDeliveryFactorTrait;
    use HasReceiveCommissionTrait;
    use HasCanBuyTrait;
    use HasTransportationRatioPercentageTrait;
    use HasOverPersonalTurnoverTrait;
    use HasCanSeeDownLineTrait;
    use HasNetworkTrait;
    use HasBtobTrait;
    use HasBtocTrait;
    use HasDeliveryTrait;
    use HasWarehouseTrait;
    use HasWarrantyDaysTrait;
    use HasMaxClientRootTrait;
    use HasIsActiveTrait;

    /**
     * @var string[] Guarded.
     */
    protected $guarded = [
        self::ID
    ];

    /**
     * Filter scope.
     *
     * @param Builder       $builder Builder.
     * @param PartnerFilter $filters Filters.
     *
     * @return Builder
     */
    public function scopeFilter(Builder $builder, PartnerFilter $filters): Builder
    {
        return $filters->apply($builder);
    }

    /**
     * get Left Name
     * @return string
     */
    public function getLftName(): string
    {
        return self::LEFT_TREE;
    }

    /**
     * get Right Name
     * @return string
     */
    public function getRgtName(): string
    {
        return self::RIGHT_TREE;
    }

    /**
     * get Parent Id Name
     * @return string
     */
    public function getParentIdName(): string
    {
        return self::PARENT_ID;
    }

    /**
     * set Parent Attribute
     * @param integer $value Parent Id.
     * @return void
     */
    public function setParentAttribute(int $value): void
    {
        $this->setParentId($value);
    }

    /**
     * Create new Object.
     *
     * @param array $attributes Attribute to create an Entity.
     * @return PartnerInterface
     */
    public static function createObject(array $attributes): PartnerInterface
    {
        $partner = self::create($attributes);

        return $partner;
    }

    /**
     * Update an Object.
     *
     * @param array $attributes Attribute to update an Entity.
     * @return PartnerInterface
     */
    public function updateObject(array $attributes): PartnerInterface
    {
        $this->update($attributes);

        return $this;
    }
}
