<?php

namespace Tests\Feature;

use App\Constants\PermissionTitle;
use App\Models\User\Permission;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    /**
     * @test
     */
    public function userWithoutLoginCanNotGetAllPermissions()
    {
        Permission::factory()->count(5)->create();
        $response = $this->getJson('/api/permissions')->assertUnauthorized();
    }
    /**
     * @test
     */
    public function userWithoutPermissionCanNotGetAllPermissions()
    {
        $this->actingAsUser();
        Permission::factory()->count(5)->create();
        $this->getJson('/api/permissions')->assertForbidden();
    }
    /**
     * @test
     */
    public function getAllPermissions()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_PERMISSIONS);
        Permission::factory()->count(5)->create();
        $response = $this->getJson('/api/permissions')->assertOk();
        $this->assertEquals(count($response->getOriginalContent()), 6);
        $response = $this->getJson('/api/permissions?per_page=3')->assertOk();
        $this->assertEquals(count($response->getOriginalContent()), 3);
    }
    /**
     * @test
     */
    public function getPermission()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_PERMISSION);
        $permission = Permission::factory()->create();
        $this->getJson(route('permissions.show', $permission))->assertOk();
    }
    /**
     * @test
     */
    public function userWithoutLoginCanNotGetPermission()
    {
        $permission = Permission::factory()->create();
        $response = $this->getJson(route('permissions.show', $permission))->assertUnauthorized();
    }
    /**
     * @test
     */
    public function userWithoutPermissionCanNotGetPermission()
    {
        $this->actingAsUser();
        $permission = Permission::factory()->create();
        $this->getJson(route('permissions.show', $permission))->assertForbidden();
    }
}
