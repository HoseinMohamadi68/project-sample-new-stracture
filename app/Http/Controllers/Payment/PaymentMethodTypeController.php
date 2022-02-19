<?php

namespace App\Http\Controllers\Payment;

use App\Filters\Payment\PaymentMethodTypeFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Payment\PaymentMethodTypeResource;
use App\Models\Payment\PaymentMethodType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PaymentMethodTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param PaymentMethodTypeFilter $filters Filter.
     *
     * @param Request                 $request Request.
     *
     * @return AnonymousResourceCollection
     */
    public function index(PaymentMethodTypeFilter $filters, Request $request): AnonymousResourceCollection
    {
        return PaymentMethodTypeResource::collection(
            PaymentMethodType::filter($filters)->paginate($this->getPageSize($request))
        );
    }

    /**
     * * Display the specified resource.
     *
     * @param PaymentMethodType $payment Payment.
     *
     * @return PaymentMethodTypeResource
     */
    public function show(PaymentMethodType $payment): PaymentMethodTypeResource
    {
        return new PaymentMethodTypeResource($payment);
    }
}
