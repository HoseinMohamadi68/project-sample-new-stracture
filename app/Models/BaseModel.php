<?php

namespace App\Models;

use App\Interfaces\Models\BaseModelInterface;
use App\Traits\HasIdTrait;
use App\Traits\MagicMethodsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model implements BaseModelInterface
{
    use HasFactory;
    use HasIdTrait;
    use MagicMethodsTrait;

    const ID = 'id';
}
