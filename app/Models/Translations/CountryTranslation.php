<?php

namespace App\Models\Translations;

use App\Models\BaseModel;
use App\Traits\HasCountryIdTrait;
use App\Traits\HasLocaleTrait;
use App\Traits\HasNameTrait;

class CountryTranslation extends BaseModel
{
    use HasCountryIdTrait;
    use HasLocaleTrait;
    use HasNameTrait;

    const TABLE = 'country_translations';

    const COUNTRY_ID = 'country_id';
    const LOCALE = 'locale';
    const NAME = 'name';

    /**
     * @var boolean $timestamps
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        self::COUNTRY_ID,
        self::LOCALE,
        self::NAME,
    ];
}
