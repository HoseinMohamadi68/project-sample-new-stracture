<?php

namespace Tests\Feature;

use App\Constants\PermissionTitle;
use App\Models\User\Role;
use App\Models\User\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function testUsersCanSeeTheirRoles()
    {
        $user = $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_USER_ROLES);
        $this->getJson('/api/users/' . $user->getId() . '/roles')->assertOk();
    }

    /**
     * @test
     */
    public function testUsersCantSeeTheirRolesWithoutPermission()
    {
        $user = User::factory()->create();
        $this->actingAsUser($user);
        $this->getJson('/api/users/' . $user->getId() . '/roles')->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * @test
     */
    public function testUserCanDeleteUserRole()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create();
        $user->roles()->attach($role->getId());
        $this->actingAsUserWithPermission(PermissionTitle::DELETE_USER_ROLE);
        $this->deleteJson("api/users/{$user->getId()}/roles/{$role->getId()}")->assertOk();
    }
    /**
     * @test
     */
    public function testUserCantDeleteUserRoleWithoutPermission()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create();
        $user->roles()->attach($role->getId());

        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_USERS);

        $this->deleteJson("api/users/{$user->getId()}/roles/{$role->getId()}")
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

}
