<?php

namespace App\Models\Contacts;

use App\Filters\Contacts\PhoneFilter;
use App\Interfaces\Models\Contacts\PhoneModelInterface;
use App\Models\BaseModel;
use App\Traits\HasIdTrait;
use App\Traits\HasNumberTrait;
use App\Traits\HasTypeTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Phone extends BaseModel implements PhoneModelInterface
{
    use HasFactory;
    use HasIdTrait;
    use HasTypeTrait;
    use HasNumberTrait;

    /**
     * @var string[]
     */
    protected $fillable = [self::TYPE, self::NUMBER];

    /**
     * @var array
     */
    public static array $types = [
        self::FAX,
        self::PHONE,
        self::MOBILE
    ];

    /**
     * @param Builder     $builder Builder.
     * @param PhoneFilter $filters Filter.
     *
     * @return Builder
     */
    public function scopeFilter(Builder $builder, PhoneFilter $filters): Builder
    {
        return $filters->apply($builder);
    }

    /**
     * @param string $type   Type.
     * @param string $number Number.
     *
     * @return PhoneModelInterface
     */
    public static function createObject(string $type, string $number): PhoneModelInterface
    {
        $phone = new static();
        $phone->setType($type);
        $phone->setNumber($number);
        $phone->save();

        return $phone;
    }

    /**
     * @param string $type   Type.
     * @param string $number Number.
     *
     * @return PhoneModelInterface
     */
    public function updateObject(string $type, string $number): PhoneModelInterface
    {
        $this->setType($type);
        $this->setNumber($number);
        $this->save();

        return $this;
    }
}
