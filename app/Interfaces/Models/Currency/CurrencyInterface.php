<?php

namespace App\Interfaces\Models\Currency;

use App\Interfaces\Models\BaseModelInterface;
use App\Interfaces\Traits\HasIsDefaultInterface;
use App\Interfaces\Traits\HasTitleInterface;

interface CurrencyInterface extends
    BaseModelInterface,
    HasTitleInterface,
    HasIsDefaultInterface
{
    /**
     * @param string  $title     Title.
     * @param float   $ratio     Ratio.
     * @param boolean $isDefault IsDefault.
     * @param string  $symbol    Symbol.
     * @param string  $iso3      Iso3.
     * @return CurrencyInterface
     */
    public static function createObject(
        string $title,
        float $ratio,
        bool $isDefault,
        string $symbol,
        string $iso3
    ): CurrencyInterface;

    /**
     * @param string  $title     Title.
     * @param float   $ratio     Ratio.
     * @param boolean $isDefault IsDefault.
     * @param string  $symbol    Symbol.
     * @param string  $iso3      Iso3.
     * @return CurrencyInterface
     */
    public function updateObject(
        string $title,
        float $ratio,
        bool $isDefault,
        string $symbol,
        string $iso3
    ): CurrencyInterface;
}
