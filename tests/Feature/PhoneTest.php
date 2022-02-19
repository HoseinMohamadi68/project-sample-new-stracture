<?php

namespace Tests\Feature;

use App\Constants\PermissionTitle;
use App\Models\Contacts\Phone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class PhoneTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function testUserCanSeePhoneList()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_PHONES);

        $this->getJson(
            route('phone.index'),
        )->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function testUserCantSeePhoneList()
    {
        $this->actingAsUser();

        $this->getJson(
            route('phone.index'),
        )->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * @test
     */
    public function testUserCanSeePhoneWithId()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_PHONE);

        $phone = Phone::factory()->create();

        $response = $this->getJson(
            route('phone.show', $phone->getId()),
        )->assertStatus(Response::HTTP_OK);

        $this->assertEquals($phone->getType(), $response->getOriginalContent()->getType());
        $this->assertEquals($phone->getNumber(), $response->getOriginalContent()->getNumber());
    }

    /**
     * @test
     */
    public function testUserCantDeletePhone()
    {
        $phone = Phone::factory()->create();

        $this->actingAsUser();
        $this->getJson(
            route('phone.destroy', $phone),
        )->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * @test
     */
    public function testUserCanDeletePhone()
    {
        $this->actingAsUserWithPermission(PermissionTitle::DELETE_PHONE);
        $phone = Phone::factory()->create();

        $this->deleteJson(
            route('phone.destroy', $phone),
        )->assertNoContent();

        $deletedPhone = Phone::whereId($phone->getId())->first();
        $this->assertNull($deletedPhone);
    }

    /**
     * @test
     */
    public function testUserCantDeletePhoneWithWrongId()
    {
        $this->actingAsUserWithPermission(PermissionTitle::DELETE_PHONE);
        $this->deleteJson(
            route('phone.destroy', 15),
        )->assertStatus(Response::HTTP_NOT_FOUND);;
    }

    /**
     * @test
     */
    public function testPhoneCanCreate()
    {
        $this->actingAsUserWithPermission(PermissionTitle::CREATE_PHONE);

        $phone = Phone::factory()->make();

        $response = $this->postJson(route('phone.store'),
            [
                Phone::TYPE => $phone->getType(),
                Phone::NUMBER => $phone->getNumber(),
            ]
        )->assertStatus(Response::HTTP_CREATED);

        $this->assertEquals($phone->getType(), $response->getOriginalContent()->getType());
        $this->assertEquals($phone->getNumber(), $response->getOriginalContent()->getNumber());
    }

    /**
     * @test
     */
    public function testUserCantCreatePhoneWithoutPermission()
    {
        $this->actingAsUser();
        $this->postJson(
            route('phone.store'),
        )->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * @test
     */
    public function testCanNotCreatePhoneCheckRequiredFieldParameter()
    {
        $this->actingAsUserWithPermission(PermissionTitle::CREATE_PHONE);

        $response = $this->postJson(
            route('phone.store'),
            []
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        /** @var array $content */
        $phone = $response->getOriginalContent()->toArray();
        $this->assertArrayHasKey(Phone::TYPE, $phone);
        $this->assertArrayHasKey(Phone::NUMBER, $phone);
    }

    /**
     * @test
     */
    public function testCanNotCreatePhoneCheckFieldParameter()
    {
        $this->actingAsUserWithPermission(PermissionTitle::CREATE_PHONE);

        $response = $this->postJson(
            route('phone.store'),
            [
                Phone::TYPE => $this->faker->word
            ]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        /** @var array $content */
        $content = $response->getOriginalContent()->toArray();

        $this->assertArrayHasKey(Phone::TYPE, $content);
        $this->assertArrayHasKey(Phone::NUMBER, $content);
    }

    /**
     * @test
     */
    public function testUserCantUpdatePhoneWithoutPermission()
    {
        $this->actingAsUser();
        $phone = Phone::factory()->create();
        $this->putJson(
            route('phone.update', $phone->getId()),
        )->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * @test
     */
    public function testUserCanUpdatePhone()
    {
        $this->actingAsUserWithPermission(PermissionTitle::UPDATE_PHONE);

        $phone = Phone::factory()->create();

        $type = Phone::PHONE;
        $number = $this->faker->phoneNumber;
        $response = $this->putJson(
            route('phone.update', $phone->getId()),
            [
                Phone::TYPE => $type,
                Phone::NUMBER => $number,
            ]
        )->assertStatus(Response::HTTP_OK);

        $this->assertEquals($type, $response->getOriginalContent()->getType());
        $this->assertEquals($number, $response->getOriginalContent()->getNumber());
    }

    /**
     * @test
     */
    public function testfilterPhoneByHasType()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_PHONES);

        $firstPhone = Phone::factory()->create([Phone::TYPE => Phone::MOBILE]);
        $secondPhone = Phone::factory()->create([Phone::TYPE => Phone::PHONE]);

        $response = $this->getJson(route('phone.index') . '?type=' . $firstPhone->getType())
            ->assertStatus(Response::HTTP_OK);

        $this->assertTrue(
            $response->getOriginalContent()->contains(Phone::TYPE, $firstPhone->getType())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(Phone::TYPE, $secondPhone->getType())
        );
    }

    /**
     * @test
     */
    public function testfilterPhoneByHasNumber()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_PHONES);

        $firstPhone = Phone::factory()->create();
        $secondPhone = Phone::factory()->create([Phone::NUMBER => '09103981627']);

        $response = $this->getJson(route('phone.index') . '?number=' . $firstPhone->getNumber())
            ->assertStatus(Response::HTTP_OK);

        $this->assertTrue(
            $response->getOriginalContent()->contains(Phone::NUMBER, $firstPhone->getNumber())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(Phone::NUMBER, $secondPhone->getNumber())
        );
    }

    /**
     * @test
     */
    public function testCanNotCreateCurrencyCheckUniqueNumber()
    {
        $this->actingAsUserWithPermission(PermissionTitle::CREATE_PHONE);
        $firstPhone = Phone::factory()->create();
        $this->postJson(
            route('phone.store'),
            [
                Phone::TYPE => $firstPhone->getType(),
                Phone::NUMBER => $firstPhone->getNumber(),
            ]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @test
     */
    public function testUserCanNotUpdatePhoneCheckUniqueNumber()
    {
        $this->actingAsUserWithPermission(PermissionTitle::UPDATE_PHONE);

        $phone = Phone::factory()->create();

        $this->putJson(
            route('phone.update', $phone->getId()),
            [
                Phone::TYPE => $phone->getType(),
                Phone::NUMBER => $phone->getNumber(),
            ]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
