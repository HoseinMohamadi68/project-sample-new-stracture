<?php

namespace Tests\Feature;

use App\Constants\PermissionTitle;
use App\Models\Contacts\Email;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class EmailTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * @test
     */
    public function testUserCanSeeEmailList()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_EMAILS);

        $this->getJson(
            route('email.index'),
        )->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function testUserCantSeeEmailList()
    {
        $this->actingAsUser();

        $this->getJson(
            route('email.index'),
        )->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * @test
     */
    public function testUserCanSeeEmailWithId()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_EMAIL);

        $email = Email::factory()->create();

        $response = $this->getJson(
            route('email.show', $email->getId()),
        )->assertStatus(Response::HTTP_OK);

        $this->assertEquals($email->getEmail(), $response->getOriginalContent()->getEmail());

    }

    /**
     * @test
     */
    public function testUserCantDeleteEmail()
    {
        $email = Email::factory()->create();

        $this->actingAsUser();
        $this->getJson(
            route('email.destroy', $email),
        )->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * @test
     */
    public function testUserCanDeleteEmail()
    {
        $this->actingAsUserWithPermission(PermissionTitle::DELETE_EMAIL);
        $email = Email::factory()->create();

        $this->deleteJson(
            route('email.destroy', $email),
        )->assertNoContent();

        $deletedEmail = Email::whereId($email->getId())->first();
        $this->assertNull($deletedEmail);
    }

    /**
     * @test
     */
    public function testUserCantDeleteEmailWithWrongId()
    {
        $this->actingAsUserWithPermission(PermissionTitle::DELETE_EMAIL);
        $this->deleteJson(
            route('email.destroy', 15),
        )->assertStatus(Response::HTTP_NOT_FOUND);;
    }

    /**
     * @test
     */
    public function testEmailCanCreate()
    {
        $this->actingAsUserWithPermission(PermissionTitle::CREATE_EMAIL);

        $email = Email::factory()->make();

        $response = $this->postJson(route('email.store'),
            [
                Email::EMAIL => $email->getEmail(),
            ]
        )->assertStatus(Response::HTTP_CREATED);

        $this->assertEquals($email->getEmail(), $response->getOriginalContent()->getEmail());
    }


    /**
     * @test
     */
    public function testUserCantCreateEmailWithoutPermission()
    {
        $this->actingAsUser();
        $this->postJson(
            route('email.store'),
        )->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * @test
     */
    public function testCanNotCreateEmailCheckRequiredFieldParameter()
    {
        $this->actingAsUserWithPermission(PermissionTitle::CREATE_EMAIL);

        $response = $this->postJson(
            route('email.store'),
            []
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        /** @var array $content */
        $email = $response->getOriginalContent()->toArray();
        $this->assertArrayHasKey(Email::EMAIL, $email);
    }

    /**
     * @test
     */
    public function testCanNotCreateEmailCheckFieldParameter()
    {
        $this->actingAsUserWithPermission(PermissionTitle::CREATE_EMAIL);

        $response = $this->postJson(
            route('email.store'),
            [
                Email::EMAIL => $this->faker->word
            ]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        /** @var array $content */
        $content = $response->getOriginalContent()->toArray();

        $this->assertArrayHasKey(Email::EMAIL, $content);
    }

    /**
     * @test
     */
    public function testUserCantUpdateEmailWithoutPermission()
    {
        $this->actingAsUser();
        $email = Email::factory()->create();
        $this->putJson(
            route('email.update', $email->getId()),
        )->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * @test
     */
    public function testUserCanUpdateEmail()
    {
        $this->actingAsUserWithPermission(PermissionTitle::UPDATE_EMAIL);

        $email = Email::factory()->create();
        $emailNow = $this->faker->email;

        $response = $this->putJson(
            route('email.update', $email->getId()),
            [
                Email::EMAIL => $emailNow
            ]
        )->assertStatus(Response::HTTP_OK);

        $this->assertEquals($emailNow, $response->getOriginalContent()->getEmail());
    }

    /**
     * @test
     */
    public function testfilterEmailByHasEmail()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_EMAILS);

        $firstEmail = Email::factory()->create();
        $secondEmail = Email::factory()->create();

        $response = $this->getJson(route('email.index') . '?email=' . $firstEmail->getEmail())
            ->assertStatus(Response::HTTP_OK);

        $this->assertTrue(
            $response->getOriginalContent()->contains(Email::EMAIL, $firstEmail->getEmail())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(Email::EMAIL, $secondEmail->getEmail())
        );
    }

    /**
     * @test
     */
    public function testCanNotCreateCurrencyCheckUniqueEmail()
    {
        $this->actingAsUserWithPermission(PermissionTitle::CREATE_EMAIL);
        $firstEmail = Email::factory()->create();
        $this->postJson(
            route('email.store'),
            [
                Email::EMAIL => $firstEmail->getEmail(),
            ]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @test
     */
    public function testUserCanNotUpdateEmailCheckUniqueEmail()
    {
        $this->actingAsUserWithPermission(PermissionTitle::UPDATE_EMAIL);

        $email = Email::factory()->create();

        $this->putJson(
            route('email.update', $email->getId()),
            [
                Email::EMAIL => $email->getEmail()
            ]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
