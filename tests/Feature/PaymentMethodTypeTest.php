<?php

namespace Tests\Feature;

use App\Constants\PermissionTitle;
use App\Models\Payment\PaymentMethodType;
use Tests\TestCase;

class PaymentMethodTypeTest extends TestCase
{
    /**
     * @test
     */
    public function userWithoutLoginCanNotGetAllPaymentMethodTypes()
    {
        PaymentMethodType::factory()->count(5)->create();
        $this->getJson(
            route('payment-method-types.index')
        )->assertUnauthorized();
    }

    /**
     * @test
     */
    public function userWithoutPermissionCanNotGetAllPaymentMethodTypes()
    {
        $this->actingAsUser();
        PaymentMethodType::factory()->count(5)->create();
        $this->getJson(
            route('payment-method-types.index')
        )->assertForbidden();
    }

    /**
     * @test
     */

    public function getAllPaymentMethodTypes()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_PAYMENT_METHOD_TYPES);
        PaymentMethodType::factory()->count(20)->create();
        $response = $this->getJson(
            route('payment-method-types.index', ['per_page' => 20])
        )->assertOk();


        $this->assertEquals(count($response->getOriginalContent()), 20);

        $response = $this->getJson(
            route('payment-method-types.index', ['per_page' => 10])
        )->assertOk();

        $this->assertEquals(count($response->getOriginalContent()), 10);
    }

    /**
     * @test
     */
    public function getPaymentMethodType()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_PAYMENT_METHOD_TYPE);
        $payment = PaymentMethodType::factory()->create();
        $this->getJson(
            route('payment-method-types.show', $payment)
        )->assertOk();
    }

    /**
     * @test
     */
    public function userWithoutLoginCanNotGetPaymentMethodType()
    {
        $payment = PaymentMethodType::factory()->create();
        $this->getJson(
            route('payment-method-types.show', $payment)
        )->assertUnauthorized();
    }

    /**
     * @test
     */
    public function userWithoutPermissionCanNotGetPaymentMethodType()
    {
        $this->actingAsUser();
        $payment = PaymentMethodType::factory()->create();
        $this->getJson(
            route('payment-method-types.show', $payment)
        )->assertForbidden();
    }
}
