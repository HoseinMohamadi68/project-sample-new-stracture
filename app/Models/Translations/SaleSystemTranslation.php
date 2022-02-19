<?php

namespace App\Models\Translations;

use App\Models\BaseModel;
use App\Traits\HasDescriptionTrait;
use App\Traits\HasLocaleTrait;
use App\Traits\HasNameTrait;
use App\Traits\HasSaleSystemIdTrait;
use App\Traits\HasRoleIdTrait;
use App\Traits\HasTitleTrait;

class SaleSystemTranslation extends BaseModel
{
    use HasNameTrait;
    use HasDescriptionTrait;
    use HasSaleSystemIdTrait;
    use HasLocaleTrait;

    const TABLE = 'sale_system_translations';
    const SALE_SYSTEM_ID = 'sale_system_id';
    const LOCALE = 'locale';
    const NAME = 'name';
    const DESCRIPTION = 'description';

    /** @var boolean $timestamps */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        self::SALE_SYSTEM_ID,
        self::DESCRIPTION,
        self::LOCALE,
        self::NAME,
    ];
}
