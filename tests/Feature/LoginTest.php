<?php

namespace Tests\Feature;

use App\Constants\PermissionTitle;
use App\Interfaces\Models\User\UserInterface;
use App\Models\User\Permission;
use App\Models\User\Role;
use App\Models\User\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * @test
     */
    public function testUserCanLoginWithCorrectData()
    {
        Artisan::call('passport:install',['-vvv' => true]);
        $user = User::factory()->create();

        $response = $this->postJson(
            '/api/login',
            [
                User::EMAIL => $user->getEmail(),
                User::PASSWORD => '123',
            ]
        );

        $response->assertOk();
        $this->assertIsArray($response->getOriginalContent());
        $this->assertArrayHasKey('token', $response->getOriginalContent()['data']);
        $this->assertArrayHasKey('user', $response->getOriginalContent()['data']);
        $this->assertInstanceOf(UserInterface::class, $response->getOriginalContent()['data']['user']);
    }

    /**
     * @test
     */
    public function testUserCantLoginWithIncorrectPassword()
    {
        Artisan::call('passport:install',['-vvv' => true]);
        $user = User::factory()->create();

        $response = $this->postJson(
            '/api/login',
            [
                User::EMAIL => $user->getEmail(),
                User::PASSWORD => '123d',
            ]
        );
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @test
     */
    public function testUserCantLoginWithIncorrectEmail()
    {
        Artisan::call('passport:install',['-vvv' => true]);
        User::factory()->create();

        $response = $this->postJson(
            '/api/login',
            [
                User::EMAIL => 'a@a.com',
                User::PASSWORD => '123d',
            ]
        );
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @test
     */
    public function testUserSignedInUserCanLogout()
    {
        $user = User::factory()->create();
        $actingUser = $this->actingAsUser($user);

        $response = $this->getJson('/api/logout', []);
        $response->assertOk();
    }

    /**
     * @test
     */
    public function testUserNotSignedInUserCantLogout()
    {
        $user = User::factory()->create();
        $response = $this->getJson('/api/logout', []);
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
