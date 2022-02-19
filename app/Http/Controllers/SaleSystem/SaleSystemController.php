<?php

namespace App\Http\Controllers\SaleSystem;

use App\Filters\SaleSystem\SaleSystemFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaleSystem\SaleSystemRequest;
use App\Http\Resources\SaleSystem\SaleSystemResource;
use App\Models\SaleSystem\SaleSystem;
use App\Repositories\SaleSystem\SaleSystemRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class SaleSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param SaleSystemFilter $filters SaleSystemFilter.
     * @param Request          $request Request.
     *
     * @return AnonymousResourceCollection
     */
    public function index(SaleSystemFilter $filters, Request $request): AnonymousResourceCollection
    {
        return SaleSystemResource::collection(SaleSystem::filter($filters)->paginate($this->getPageSize($request)));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SaleSystemRequest    $request    RoleRequest.
     * @param SaleSystemRepository $repository SaleSystem Repository.
     * @return SaleSystemResource
     */
    public function store(SaleSystemRequest $request, SaleSystemRepository $repository): SaleSystemResource
    {
        $saleSystem = $repository->store($request->validated());

        return new SaleSystemResource($saleSystem);
    }

    /**
     * Display the specified resource.
     *
     * @param SaleSystem $saleSystem SaleSystem Object Model.
     *
     * @return SaleSystemResource
     */
    public function show(SaleSystem $saleSystem): SaleSystemResource
    {
        return new SaleSystemResource($saleSystem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SaleSystemRequest    $request    Request.
     * @param SaleSystemRepository $repository SaleSystem Repository.
     * @param SaleSystem           $saleSystem SaleSystem Object Model.
     *
     * @return SaleSystemResource
     */
    public function update(
        SaleSystemRequest $request,
        SaleSystemRepository $repository,
        SaleSystem $saleSystem
    ): SaleSystemResource {
        $saleSystem = $repository->update($saleSystem, $request->validated());

        return new SaleSystemResource($saleSystem);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SaleSystem $saleSystem SaleSystem Object Model.
     *
     * @return JsonResponse
     */
    public function destroy(SaleSystem $saleSystem): JsonResponse
    {
        try {
            $saleSystem->delete();

            return $this->getResponse([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            Log::error('Delete SaleSystem Error : ' . $exception->getMessage());

            return $this->getResponse(
                ['message' => __('error.can_not_delete_parameter', ['parameter' => __('error.sale_system')])],
                Response::HTTP_CONFLICT
            );
        }
    }
}
