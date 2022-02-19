<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    const EXCEPTION_MESSAGE = 'message';
    const DEFAULT_PAGE_SIZE = 10;
    const PER_PAGE = 'per_page';

    /**
     * @param Request $request BaseRequest.
     *
     * @return mixed
     */
    protected function getPageSize(Request $request): mixed
    {
        $pageSize = self::DEFAULT_PAGE_SIZE;
        if ($request->has(self::PER_PAGE) && !empty($request->get(self::PER_PAGE))) {
            $pageSize = (int)$request->get(self::PER_PAGE);
        }
        return $pageSize;
    }

    /**
     * @param array|null $content    Content.
     * @param integer    $statusCode Status Code.
     * @param array|null $heathers   Headers.
     *
     * @return JsonResponse
     */
    protected function getResponse(
        ?array $content = null,
        int $statusCode = Response::HTTP_OK,
        ?array $heathers = []
    ): JsonResponse {
        if (
            isset($content[self::EXCEPTION_MESSAGE]) &&
            !in_array(env('APP_ENV'), ['local', 'development', 'testing'])
        ) {
            unset($content[self::EXCEPTION_MESSAGE]);
        }

        return response()->json(['data' => $content], $statusCode, $heathers);
    }
}
