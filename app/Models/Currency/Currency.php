<?php

namespace App\Models\Currency;

use App\Filters\Currency\CurrencyFilter;
use App\Interfaces\Models\Currency\CurrencyInterface;
use App\Traits\HasIsDefaultTrait;
use App\Traits\HasTitleTrait;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends BaseModel implements CurrencyInterface
{
    use HasFactory;
    use HasTitleTrait;
    use HasIsDefaultTrait;

    const TABLE = 'currencies';
    const ID = 'id';
    const RATIO = 'ratio';
    const IS_DEFAULT = 'is_default';
    const SYMBOL = 'symbol';
    const ISO3 = 'iso3';

    /**
     * @var string[]
     */
    protected $fillable = [
        self::ID,
        self::TITLE,
        self::RATIO,
        self::IS_DEFAULT,
        self::SYMBOL,
        self::ISO3
    ];

    /**
     * @var boolean
     */
    public $timestamps = false;

    /**
     * @param Builder        $builder Builder.
     * @param CurrencyFilter $filters Filters.
     * @return Builder
     */
    public function scopeFilter(Builder $builder, CurrencyFilter $filters): Builder
    {
        return $filters->apply($builder);
    }

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
    ): CurrencyInterface {
        $currncy = new static();
        $currncy->setTitle($title);
        $currncy->setRatio($ratio);
        $currncy->setIsDefault($isDefault);
        $currncy->setSymbol($symbol);
        $currncy->setIso3($iso3);
        $currncy->save();

        return $currncy;
    }

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
    ): CurrencyInterface {
        $this->setTitle($title);
        $this->setRatio($ratio);
        $this->setIsDefault($isDefault);
        $this->setSymbol($symbol);
        $this->setIso3($iso3);
        $this->save();

        return $this;
    }
}
