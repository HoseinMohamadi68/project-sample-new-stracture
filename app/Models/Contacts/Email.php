<?php

namespace App\Models\Contacts;

use App\Filters\Contacts\EmailFilter;
use App\Interfaces\Models\Contacts\EmailInterface;
use App\Traits\HasEmailTrait;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Email extends BaseModel implements EmailInterface
{
    use HasFactory;
    use HasEmailTrait;

    /**
     * @var string[]
     */
    protected $fillable = [self::EMAIL];

    /**
     * @param Builder     $builder Builder.
     * @param EmailFilter $filters Filter.
     *
     * @return Builder
     */
    public function scopeFilter(Builder $builder, EmailFilter $filters): Builder
    {
        return $filters->apply($builder);
    }

    /**
     * @param string $email Email.
     *
     * @return EmailInterface
     */
    public static function createObject(string $email): EmailInterface
    {
        $emails = new static();
        $emails->setEmail($email);
        $emails->save();

        return $emails;
    }

    /**
     * @param string $email Email.
     *
     * @return EmailInterface
     */
    public function updateObject(string $email): EmailInterface
    {
        $this->setEmail($email);
        $this->save();

        return $this;
    }
}
