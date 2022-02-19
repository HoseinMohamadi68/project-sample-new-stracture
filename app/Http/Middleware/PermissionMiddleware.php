<?php

namespace App\Http\Middleware;

use App\Models\User\Permission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class PermissionMiddleware
{
    /** @var Route */
    private $route;

    /**
     * CheckPermission constructor.
     *
     * @param Route $route Route.
     */
    public function __construct(Route $route)
    {
        $this->route = $route;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request Request.
     * @param Closure $next Closure.
     * @param string|null $permission Permission.
     * @param string|null $secondPermission Permission.
     *
     * @return mixed
     */
    public function handle(
        Request $request,
        Closure $next,
        ?string $permission = null,
        ?string $secondPermission = null
    ) {
        $model = str_replace(
            'Controller',
            '',
            substr(
                strrchr(
                    get_class($this->route->controller),
                    '\\'
                ),
                1
            )
        );
        if ($permission === null) {
            $permission = Permission::generatePermissionTitle(
                $this->route->getActionMethod(),
                $model,
                $this->splitCamelCase($this->route->getActionMethod())
            );
        }

        $check = $request->user()->hasPermission($permission);

        if ($secondPermission) {
            $check = ($permission && $request->user()->hasPermission($permission)) ||
                ($secondPermission && $request->user()->hasPermission($secondPermission));
        }

        abort_if(
            !($check),
            403,
            __('error.you_are_not_allowed_to_perform_this_action')
        );

        return $next($request);
    }


    public function splitCamelCase(string $string): array
    {
        $method_name_in_array = str_split($string);

        $camel_index = null;
        foreach($method_name_in_array as $index => $char) {
            if(ctype_upper($char)) {
                $camel_index = $index;
            }
        }

        return is_null($camel_index) ?
            [$string] :
            [
                substr($string, 0, $camel_index), substr($string, $camel_index)
            ];
    }

}
