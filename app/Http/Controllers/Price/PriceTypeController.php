<?php

namespace App\Http\Controllers\Price;

use App\Filters\Price\PriceTypeFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Price\PriceTypeRequest;
use App\Http\Resources\Price\PriceTypeResource;
use App\Interfaces\Models\Perice\PriceTypeInterface;
use App\Models\Price\PriceType;
use App\Repositories\Price\PriceTypeRepository;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class PriceTypeController extends Controller
{
    /** @var PriceTypeRepository $repository */
    private PriceTypeRepository $repository;

    /**
     * RoleController constructor.
     * @param PriceTypeRepository $repository Repository.
     */
    public function __construct(PriceTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param PriceTypeFilter $filters PriceTypeFilter.
     * @param Request         $request Request.
     *
     * @return AnonymousResourceCollection
     */
    public function index(PriceTypeFilter $filters, Request $request): AnonymousResourceCollection
    {
        return PriceTypeResource::collection(PriceType::filter($filters)->paginate($this->getPageSize($request)));
    }

    /**
     * @param PriceTypeRequest $request PriceTypeRequest.
     *
     * @return PriceTypeResource
     */
    public function store(PriceTypeRequest $request): PriceTypeResource
    {
        $result = $this->repository->store($request->validated());

        return new PriceTypeResource($result);
    }

    /**
     * @param PriceType $priceType PriceType.
     *
     * @return PriceTypeResource
     */
    public function show(PriceType $priceType): PriceTypeResource
    {
        return new PriceTypeResource($priceType);
    }

    /**
     * @param PriceTypeRequest $request   PriceTypeRequest.
     * @param PriceType        $priceType PriceType.
     *
     * @return PriceTypeResource
     */
    public function update(PriceTypeRequest $request, PriceType $priceType): PriceTypeResource
    {
        $result = $this->repository->update($priceType, $request->validated());

        return new PriceTypeResource($result);
    }

    /**
     * @param PriceType $priceType PriceType.
     *
     * @return JsonResponse
     */
    public function destroy(PriceType $priceType): JsonResponse
    {
        try {
            $priceType->delete();

            return $this->getResponse([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            Log::error('Delete Price Type Error : ' . $exception->getMessage());

            return $this->getResponse(
                ['message' => __(
                    'error.can_not_delete_parameter',
                    ['parameter' => __('error.price_type')]
                )],
                Response::HTTP_CONFLICT
            );
        }
    }
}
