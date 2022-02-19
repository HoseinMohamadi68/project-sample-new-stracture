<?php

namespace App\Models\User;

use App\Filters\PermissionFilter;
use App\Interfaces\Models\User\PermissionInterface;
use App\Models\BaseModel;
use App\Traits\HasTitleTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Permission extends BaseModel implements PermissionInterface
{
    use HasTitleTrait;

    const TABLE = 'permissions';
    const ID = 'id';
    const TITLE = 'title';

    /**
     * @var boolean
     */
    public $timestamps = false;

    /**
     * @param Builder          $builder Builder.
     * @param PermissionFilter $filters Filters.
     *
     * @return Builder
     */
    public function scopeFilter(Builder $builder, PermissionFilter $filters): Builder
    {
        return $filters->apply($builder);
    }

    /**
     * Generate permission title.
     *
     * @param string      $methodName Method name.
     * @param string|null $slug       Slug.
     * @param array       $related    Related.
     *
     * @return string|null
     */
    public static function generatePermissionTitle(string $methodName, ?string $slug = null, array $related): ?string
    {
        if ($slug === null) {
            return null;
        }

        if (count($related) > 1) {
            switch ($related[0]) {
                case 'get':
                    $permission =  'GetAll' . $slug . $related[1];
                    break;
                case 'post':
                    $permission = 'Create' . $slug . $related[1];
                    break;
                case 'delete':
                    $permission = 'Delete' . $slug . $related[1];
                    break;


                default:
                    return null;
            }
        } else {
            switch ($methodName) {
                case 'index':
                    $plural_slug = Str::plural($slug);
                    $permission = (count($related) == 1) ? 'GetAll' . $plural_slug : 'GetAll' . $plural_slug . $related[1];
                    break;

                case 'show':
                    $permission = (count($related) == 1)  ? 'Get' . $slug : 'Get' . $slug . $related[1];
                    break;

                case 'store':
                    $permission = (count($related) == 1)  ? 'Create' . $slug : 'Create' . $slug . $related[1];
                    break;

                case 'destroy':
                    $permission = (count($related) == 1)  ? 'Delete' . $slug : 'Delete' . $slug . $related[1];
                    break;

                case 'update':
                    $permission = (count($related) == 1)  ? 'Update' . $slug : 'Update' . $slug . $related[1];
                    break;


                default:
                    return null;
            }
        }

        return $permission;
    }

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
