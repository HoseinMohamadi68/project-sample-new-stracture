<?php

namespace Tests;

use App\Models\User\Permission;
use App\Models\User\Role;
use App\Models\Translations\RoleTranslation;
use App\Models\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;

abstract class TestCase extends BaseTestCase
{
    use WithFaker;
    use RefreshDatabase;
    use CreatesApplication;

    /**
     * @param User|null $loggedInUser Logged In User.
     *
     * @return User
     */
    public function actingAsUser(User $loggedInUser = null)
    {
        if(empty($loggedInUser)) {
            $loggedInUser = User::factory()->create();
        }

        Passport::actingAs($loggedInUser);

        return $loggedInUser;
    }

    /**
     * @param string $permission Permission.
     *
     * @return User
     */
    public function actingAsUserWithPermission(string $permission)
    {
        $loggedInUser = User::factory()->create();
        Passport::actingAs($loggedInUser);
        $role = Role::factory()->create();
        RoleTranslation::factory()->create([RoleTranslation::ROLE_ID => $role->getId()]);

        $loggedInUser->roles()->attach($role);
        $permissionModel = Permission::whereTitleIs($permission)->first();
        if (!$permissionModel) {
            Permission::insert([Permission::TITLE => $permission]);
            $permissionModel = Permission::whereTitleIs($permission)->first();
        }
        $role->permissions()->sync([$permissionModel->getId()]);

        return $loggedInUser;
    }

    /**
     * @param string $permission Permission.
     *
     * @return User
     */
    public function actingAsUserWithRoleAndPermissions(string $role, ?array $permissions = [])
    {
        $loggedInUser = User::factory()->create();
        Passport::actingAs($loggedInUser);
        $role = Role::factory()->create();
        RoleTranslation::factory()->create(
            [
                RoleTranslation::ROLE_ID => $role->getId(),
                RoleTranslation::TITLE => $role
            ]
        );
        $loggedInUser->roles()->attach($role);

        if($permissions) {
            foreach ($permissions as $permission) {
                $permissionModel = Permission::whereTitleIs($permission)->first();
                if (!$permissionModel) {
                    Permission::insert([Permission::TITLE => $permission]);
                    $permissionModel = Permission::whereTitleIs($permission)->first();
                }
                $role->permissions()->attach([$permissionModel->getId()]);
            }
        }

        return $loggedInUser;
    }
}
