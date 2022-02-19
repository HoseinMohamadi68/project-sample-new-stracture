<?php

namespace App\Http\Controllers\Country;

use App\Filters\Country\CountryFilter;
use App\Filters\Language\LanguageFilter;
use App\Filters\PermissionFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Country\CountryLanguageRequest;
use App\Http\Requests\Country\CountryRequest;
use App\Http\Requests\User\PermissionRoleRequest;
use App\Http\Resources\Country\CountryResource;
use App\Http\Resources\Language\LanguageResource;
use App\Http\Resources\User\PermissionResource;
use App\Models\Country\Country;
use App\Models\Language\Language;
use App\Models\LocalizableModel;
use App\Models\User\Permission;
use App\Models\User\Role;
use App\Repositories\Country\CountryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CountryController extends Controller
{
    /** @var \App\Repositories\Country\CountryRepository $repository */
    private CountryRepository $repository;

    /**
     * RoleController constructor.
     * @param \App\Repositories\Country\CountryRepository $repository Repository.
     */
    public function __construct(CountryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param CountryFilter $filters CountryFilter.
     * @param Request       $request Request.
     *
     * @return AnonymousResourceCollection
     */
    public function index(CountryFilter $filters, Request $request): AnonymousResourceCollection
    {
        return CountryResource::collection(Country::filter($filters)->paginate($this->getPageSize($request)));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CountryRequest $request CountryRequest.
     *
     * @return JsonResponse|CountryResource
     */
    public function store(CountryRequest $request): JsonResponse|CountryResource
    {
        $result = $this->repository->store(
            [
                Country::CURRENCY_ID => $request->validated()[Country::CURRENCY_ID],
                Country::DEFAULT_VAT => $request->validated()[Country::DEFAULT_VAT],
                Country::DEFAULT_WARRANTY_DAYS => $request->validated()[Country::DEFAULT_WARRANTY_DAYS],
                Country::MAX_TAX_FREE_TRADE => $request->validated()[Country::MAX_TAX_FREE_TRADE],
                Country::MAX_SMALL_BUSINESS_TRADE => $request->validated()[Country::MAX_SMALL_BUSINESS_TRADE],
                Country::IS_EEU => $request->validated()[Country::IS_EEU],
                Country::ISO2 => $request->validated()[Country::ISO2],
                Country::ISO3 => $request->validated()[Country::ISO3],
                LocalizableModel::LOCALIZATION_KEY => $request->validated()[LocalizableModel::LOCALIZATION_KEY]
            ]
        );

        if (isset($result['error'])) {
            return $this->getResponse(['message' => $result['message']], $result['status']);
        }

        return new CountryResource($result);
    }

    /**
     * Display the specified resource.
     *
     * @param Country $country Country Object Model.
     *
     * @return CountryResource
     */
    public function show(Country $country): CountryResource
    {
        return new CountryResource($country);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CountryRequest $request CountryRequest.
     *
     * @param Country        $country Country.
     *
     * @return JsonResponse|CountryResource
     */
    public function update(CountryRequest $request, Country $country): JsonResponse|CountryResource
    {
        $result = $this->repository->update(
            $country,
            [
                Country::CURRENCY_ID => $request->validated()[Country::CURRENCY_ID],
                Country::DEFAULT_VAT => $request->validated()[Country::DEFAULT_VAT],
                Country::DEFAULT_WARRANTY_DAYS => $request->validated()[Country::DEFAULT_WARRANTY_DAYS],
                Country::MAX_TAX_FREE_TRADE => $request->validated()[Country::MAX_TAX_FREE_TRADE],
                Country::MAX_SMALL_BUSINESS_TRADE => $request->validated()[Country::MAX_SMALL_BUSINESS_TRADE],
                Country::IS_EEU => $request->validated()[Country::IS_EEU],
                Country::ISO2 => $request->validated()[Country::ISO2],
                Country::ISO3 => $request->validated()[Country::ISO3],
                LocalizableModel::LOCALIZATION_KEY => $request->validated()[LocalizableModel::LOCALIZATION_KEY]
            ]
        );

        if (isset($result['error'])) {
            return $this->getResponse(['message' => $result['message']], $result['status']);
        }

        return new CountryResource($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Country $country Country.
     *
     * @return JsonResponse
     */
    public function destroy(Country $country): JsonResponse
    {
        try {
            $country->delete();

            return $this->getResponse([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            Log::error('Delete Country Error : ' . $exception->getMessage());

            return $this->getResponse(
                ['message' => __('error.can_not_delete_parameter', ['parameter' => __('error.country')])],
                Response::HTTP_CONFLICT
            );
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param Country        $country Country.
     * @param LanguageFilter $filters Filter.
     * @param Request        $request Request.
     *
     * @return AnonymousResourceCollection
     */
    public function getLanguages(
        Country $country,
        LanguageFilter $filters,
        Request $request
    ): AnonymousResourceCollection {
        return LanguageResource::collection(
            $country->languages()->filter($filters)->paginate($this->getPageSize($request))
        );
    }

    /**
     * @param Country        $country  Country.
     * @param Language       $language Language.
     * @param LanguageFilter $filters  Filters.
     * @param Request        $request  Request.
     *
     * @return AnonymousResourceCollection
     */
    public function addLanguage(
        Country $country,
        Language $language,
        LanguageFilter $filters,
        Request $request
    ): AnonymousResourceCollection {
        if (!$country->languages()->find($language->getId())) {
            $country->languages()->attach($language->getId());
        }

        return $this->getLanguages($country, $filters, $request);
    }

    /**
     * @param Country                $country Country.
     * @param CountryLanguageRequest $request Request.
     * @param LanguageFilter         $filters Filters.
     *
     * @return AnonymousResourceCollection
     */
    public function syncLanguages(
        Country $country,
        CountryLanguageRequest $request,
        LanguageFilter $filters
    ): AnonymousResourceCollection {
        $country->languages()->sync($request->get('language_ids'));

        return $this->getLanguages($country, $filters, $request);
    }
    /**
     * @param Country        $country  Country.
     * @param Language       $language Permission.
     * @param LanguageFilter $filters  Filters.
     * @param Request        $request  Request.
     *
     * @return AnonymousResourceCollection
     */
    public function deleteLanguage(
        Country $country,
        Language $language,
        LanguageFilter $filters,
        Request $request
    ): AnonymousResourceCollection {
        $country->languages()->detach([$language->id]);

        return $this->getLanguages($country, $filters, $request);
    }
}
