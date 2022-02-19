<?php

namespace App\Interfaces\Models\Perice;

use App\Interfaces\Models\BaseModelInterface;
use App\Interfaces\Traits\HasNameInterface;

interface PriceTypeInterface extends
    BaseModelInterface
{
    const TABLE = 'price_types';

    /**
     * @return PriceTypeInterface
     */
    public static function createObject(): PriceTypeInterface;

    /**
     * @return PriceTypeInterface
     */
    public function updateObject(): PriceTypeInterface;
}
