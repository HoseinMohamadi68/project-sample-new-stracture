<?php

namespace App\Models\Translations;

use App\Models\BaseModel;
use App\Traits\HasLocaleTrait;
use App\Traits\HasRoleIdTrait;
use App\Traits\HasTitleTrait;

class RoleTranslation extends BaseModel
{
    use HasTitleTrait;
    use HasRoleIdTrait;
    use HasLocaleTrait;

    const TABLE = 'role_translations';
    const ROLE_ID = 'role_id';
    const LOCALE = 'locale';
    const TITLE = 'title';

    /** @var boolean $timestamps */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        self::ROLE_ID,
        self::LOCALE,
        self::TITLE,
    ];
}
