<?php

namespace App\Interfaces\Models\Country;

use App\Interfaces\Models\BaseModelInterface;
use App\Interfaces\Traits\BelongsToManyLanguagesInterface;
use App\Interfaces\Traits\HasCurrencyIdInterface;
use App\Interfaces\Traits\HasDefaultVatInterface;
use App\Interfaces\Traits\HasDefaultWarrantyDaysInterface;
use App\Interfaces\Traits\HasIsEeuInterface;
use App\Interfaces\Traits\HasIso2Interface;
use App\Interfaces\Traits\HasIso3Interface;
use App\Interfaces\Traits\HasMaxSmallBusinessTradeInterface;
use App\Interfaces\Traits\HasMaxTaxFreeTradeInterface;

interface CountryInterface extends
    BaseModelInterface,
    HasCurrencyIdInterface,
    HasDefaultVatInterface,
    HasDefaultWarrantyDaysInterface,
    HasIsEeuInterface,
    HasMaxTaxFreeTradeInterface,
    HasMaxSmallBusinessTradeInterface,
    HasIso2Interface,
    HasIso3Interface,
    BelongsToManyLanguagesInterface
{

    const TABLE = 'countries';


    /**
     * Create new Object.
     *
     * @param array $attributes Attribute to create an Entity.
     * @return CountryInterface
     */
    public static function createObject(array $attributes): CountryInterface;


    /**
     * Update an Object.
     *
     * @param array $attributes Attribute to update an Entity.
     * @return CountryInterface
     */
    public function updateObject(array $attributes): CountryInterface;
}
