<?php

namespace App\Http\Controllers\SaleSystem;

use App\Filters\SaleSystem\PartnerFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaleSystem\PartnerRequest;
use App\Http\Resources\SaleSystem\PartnerResource;
use App\Models\SaleSystem\Partner;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param PartnerFilter $filters PartnerFilter.
     * @param Request       $request Request.
     *
     * @return AnonymousResourceCollection
     */
    public function index(PartnerFilter $filters, Request $request): AnonymousResourceCollection
    {
        return PartnerResource::collection(Partner::filter($filters)->paginate($this->getPageSize($request)));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PartnerRequest $request Partner Request.
     *
     * @return PartnerResource
     */
    public function store(PartnerRequest $request): PartnerResource
    {
        $partner = Partner::createObject(
            [
                Partner::SALE_SYSTEM_ID => $request->get(Partner::SALE_SYSTEM_ID),
                Partner::USER_ID => $request->get(Partner::USER_ID),
                Partner::PARENT_ID => $request->get(Partner::PARENT_ID),
                Partner::COACH_ID => $request->get(Partner::COACH_ID),
                Partner::IS_ACTIVE => $request->get(Partner::IS_ACTIVE),
                Partner::MOBILE => $request->get(Partner::MOBILE),
                Partner::COUNTRY_ID => $request->get(Partner::COUNTRY_ID),
                Partner::BANK_NAME => $request->get(Partner::BANK_NAME),
                Partner::IBAN => $request->get(Partner::IBAN),
                Partner::DEFAULT_WARRANTY_DAYS => $request->get(Partner::DEFAULT_WARRANTY_DAYS),
                Partner::SWIFT => $request->get(Partner::SWIFT),
                Partner::RECEIVE_VAT_RESPONSIBLE => $request->get(Partner::RECEIVE_VAT_RESPONSIBLE),
                Partner::SEND_VAT_RESPONSIBLE => $request->get(Partner::SEND_VAT_RESPONSIBLE),
                Partner::ACTIVE_AUTO_BONUS => $request->get(Partner::ACTIVE_AUTO_BONUS),
                Partner::ACTIVE_TRAINING_BONUS => $request->get(Partner::ACTIVE_TRAINING_BONUS),
                Partner::POST_DELIVERY_FACTOR => $request->get(Partner::POST_DELIVERY_FACTOR),
                Partner::RECEIVE_COMMISSION => $request->get(Partner::RECEIVE_COMMISSION),
                Partner::CAN_BUY => $request->get(Partner::CAN_BUY),
                Partner::TRANSPORTATION_RATIO_PERCENTAGE => $request->get(Partner::TRANSPORTATION_RATIO_PERCENTAGE),
                Partner::OVER_PERSONAL_TURNOVER => $request->get(Partner::OVER_PERSONAL_TURNOVER),
                Partner::CAN_SEE_DOWN_LINE => $request->get(Partner::CAN_SEE_DOWN_LINE),
                Partner::INHOUSE_SALE => $request->get(Partner::INHOUSE_SALE),
                Partner::HAS_NETWORK => $request->get(Partner::HAS_NETWORK),
                Partner::HAS_BTOB => $request->get(Partner::HAS_BTOB),
                Partner::HAS_BTOC => $request->get(Partner::HAS_BTOC),
                Partner::HAS_WAREHOUSE => $request->get(Partner::HAS_WAREHOUSE),
                Partner::HAS_DELIVERY => $request->get(Partner::HAS_DELIVERY),
                Partner::WARRANTY_DAYS => $request->get(Partner::WARRANTY_DAYS),
                Partner::MAX_CLIENT_ROOT => $request->get(Partner::MAX_CLIENT_ROOT),
                Partner::FRONT_IDENTITY_CARD_ID => $request->get(Partner::FRONT_IDENTITY_CARD_ID),
                Partner::BACK_IDENTITY_CARD_ID => $request->get(Partner::BACK_IDENTITY_CARD_ID),
                Partner::BUSINESS_CERTIFICATION_ID => $request->get(Partner::BUSINESS_CERTIFICATION_ID),
            ]
        );

        return new PartnerResource($partner);
    }

    /**
     * Display the specified resource.
     *
     * @param Partner $partner Partner Object Model.
     *
     * @return PartnerResource
     */
    public function show(Partner $partner): PartnerResource
    {
        return new PartnerResource($partner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PartnerRequest $request PartnerRequest.
     * @param Partner        $partner Partner Model.
     *
     * @return \App\Http\Resources\SaleSystem\PartnerResource
     */
    public function update(PartnerRequest $request, Partner $partner): PartnerResource
    {
        $partner = $partner->updateObject(
            [
                Partner::SALE_SYSTEM_ID => $request->get(Partner::SALE_SYSTEM_ID),
                Partner::USER_ID => $request->get(Partner::USER_ID),
                Partner::PARENT_ID => $request->get(Partner::PARENT_ID),
                Partner::COACH_ID => $request->get(Partner::COACH_ID),
                Partner::FRONT_IDENTITY_CARD_ID => $request->get(Partner::FRONT_IDENTITY_CARD_ID),
                Partner::BACK_IDENTITY_CARD_ID => $request->get(Partner::BACK_IDENTITY_CARD_ID),
                Partner::BUSINESS_CERTIFICATION_ID => $request->get(Partner::BUSINESS_CERTIFICATION_ID),
                Partner::COUNTRY_ID => $request->get(Partner::COUNTRY_ID),
                Partner::MOBILE => $request->get(Partner::MOBILE),
                Partner::BANK_NAME => $request->get(Partner::BANK_NAME),
                Partner::IBAN => $request->get(Partner::IBAN),
                Partner::DEFAULT_WARRANTY_DAYS => $request->get(Partner::DEFAULT_WARRANTY_DAYS),
                Partner::SWIFT => $request->get(Partner::SWIFT),
                Partner::RECEIVE_VAT_RESPONSIBLE => $request->get(Partner::RECEIVE_VAT_RESPONSIBLE),
                Partner::SEND_VAT_RESPONSIBLE => $request->get(Partner::SEND_VAT_RESPONSIBLE),
                Partner::ACTIVE_AUTO_BONUS => $request->get(Partner::ACTIVE_AUTO_BONUS),
                Partner::ACTIVE_TRAINING_BONUS => $request->get(Partner::ACTIVE_TRAINING_BONUS),
                Partner::POST_DELIVERY_FACTOR => $request->get(Partner::POST_DELIVERY_FACTOR),
                Partner::RECEIVE_COMMISSION => $request->get(Partner::RECEIVE_COMMISSION),
                Partner::CAN_BUY => $request->get(Partner::CAN_BUY),
                Partner::TRANSPORTATION_RATIO_PERCENTAGE => $request->get(Partner::TRANSPORTATION_RATIO_PERCENTAGE),
                Partner::OVER_PERSONAL_TURNOVER => $request->get(Partner::OVER_PERSONAL_TURNOVER),
                Partner::CAN_SEE_DOWN_LINE => $request->get(Partner::CAN_SEE_DOWN_LINE),
                Partner::INHOUSE_SALE => $request->get(Partner::INHOUSE_SALE),
                Partner::HAS_NETWORK => $request->get(Partner::HAS_NETWORK),
                Partner::HAS_BTOB => $request->get(Partner::HAS_BTOB),
                Partner::HAS_BTOC => $request->get(Partner::HAS_BTOC),
                Partner::HAS_WAREHOUSE => $request->get(Partner::HAS_WAREHOUSE),
                Partner::HAS_DELIVERY => $request->get(Partner::HAS_DELIVERY),
                Partner::WARRANTY_DAYS => $request->get(Partner::WARRANTY_DAYS),
                Partner::MAX_CLIENT_ROOT => $request->get(Partner::MAX_CLIENT_ROOT),
                Partner::IS_ACTIVE => $request->get(Partner::IS_ACTIVE),
            ]
        );

        return new PartnerResource($partner);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Partner $partner Partner Object Model.
     *
     * @return JsonResponse
     */
    public function destroy(Partner $partner): JsonResponse
    {
        try {
            $partner->delete();
        } catch (\Exception $exception) {
            Log::error('Delete Partner Error : ' . $exception->getMessage());

            return $this->getResponse(
                ['message' => __('error.can_not_delete_parameter', ['parameter' => __('error.partner')])],
                Response::HTTP_CONFLICT
            );
        }

        return $this->getResponse([], Response::HTTP_NO_CONTENT);
    }
}
