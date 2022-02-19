<?php

namespace App\Models\Translations;

use App\Models\BaseModel;
use App\Traits\HasLocaleTrait;
use App\Traits\HasNameTrait;
use App\Traits\HasPriceTypeIdTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PriceTypeTranslation extends BaseModel
{
    use HasFactory;
    use HasNameTrait;
    use HasPriceTypeIdTrait;
    use HasLocaleTrait;

    const TABLE = 'price_type_translations';
    const PRICE_TYPE_ID = 'price_type_id';
    const LOCALE = 'locale';
    const NAME = 'name';

    /** @var boolean $timestamps */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        self::PRICE_TYPE_ID,
        self::LOCALE,
        self::NAME,
    ];
}
