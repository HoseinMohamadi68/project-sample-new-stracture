<?php

namespace App\Http\Controllers\Currency;

use App\Filters\Currency\CurrencyFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Currency\CurrencyRequest;
use App\Http\Resources\Currency\CurrencyResource;
use App\Models\Currency\Currency;
use App\Repositories\Currency\CurrenciesRepo;
use Illuminate\Database\Events\TransactionBeginning;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CurrencyController extends Controller
{
    /**
     * @param CurrencyFilter $filters Filters.
     * @param Request        $request Request.
     *
     * @return AnonymousResourceCollection
     */
    public function index(CurrencyFilter $filters, Request $request): AnonymousResourceCollection
    {
        return CurrencyResource::collection(Currency::filter($filters)->paginate($this->getPageSize($request)));
    }

    /**
     * @param CurrencyRequest $request CurrencyRequest.
     *
     * @return CurrencyResource
     */
    public function store(CurrencyRequest $request): CurrencyResource
    {
        $currency = Currency::createObject(
            $request->get(Currency::TITLE),
            $request->get(Currency::RATIO),
            $request->get(Currency::IS_DEFAULT),
            $request->get(Currency::SYMBOL),
            $request->get(Currency::ISO3),
        );

        return new CurrencyResource($currency);
    }

    /**
     * @param Currency $currency Currency Object Model.
     *
     * @return CurrencyResource
     */
    public function show(Currency $currency): CurrencyResource
    {
        return new CurrencyResource($currency);
    }

    /**
     * @param CurrencyRequest $request  Request.
     * @param Currency        $currency Currency Object Model.
     *
     * @return CurrencyResource
     */
    public function update(CurrencyRequest $request, Currency $currency): CurrencyResource
    {
        $currency->updateObject(
            $request->get(Currency::TITLE),
            $request->get(Currency::RATIO),
            $request->get(Currency::IS_DEFAULT),
            $request->get(Currency::SYMBOL),
            $request->get(Currency::ISO3)
        );

        return new CurrencyResource($currency);
    }

    /**
     * @param Currency $currency Currency Object Model.
     *
     * @return JsonResponse
     */
    public function destroy(Currency $currency): JsonResponse
    {
        try {
            $currency->delete();

            return $this->getResponse([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            Log::error('Delete Currency Error : ' . $exception->getMessage());

            return $this->getResponse([], Response::HTTP_CONFLICT);
        }
    }

    /**
     * @param Currency $currency Currency Object Model.
     *
     * @return CurrencyResource|JsonResponse
     */
    public function setDefault(Currency $currency): CurrencyResource
    {
        DB::beginTransaction();
        try {
            $Repo = resolve(CurrenciesRepo::class);

            $Repo->getUpdateDeactivateAll();
            $Repo->getUpdate($currency);
        } catch (\Exception $exception) {
            Log::error('SetDefault Currency Error : ' . $exception->getMessage());
            DB::rollBack();

            return $this->getResponse([], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        DB::commit();

        return new CurrencyResource($currency);
    }
}
