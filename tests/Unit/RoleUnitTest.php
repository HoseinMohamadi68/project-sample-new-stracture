<?php

namespace Tests\Unit;

use App\Interfaces\Models\User\RoleInterface;
use App\Models\User\Role;
use Tests\TestCase;

class RoleUnitTest extends TestCase
{
    /**
     * @test
     */
    public function createRole()
    {
        $role = Role::factory()->make();
        $createdRole = Role::createObject(
            $role->{Role::OWNER_VISIBILITY},
            $role->{Role::COMPANY_VISIBILITY},
        );
        $this->assertTrue($createdRole instanceof RoleInterface);
        $this->assertEquals($createdRole->{Role::COMPANY_VISIBILITY}, $role->getCompanyVisibility());
        $this->assertEquals($createdRole->{Role::OWNER_VISIBILITY}, $role->getOwnerVisibility());
    }

    /**
     * @test
     */
    public function updateRole()
    {
        $role = Role::factory()->create();
        $companyVisibility = $this->faker->boolean;
        $ownerVisibility = $this->faker->boolean;
        $createdRole = $role->updateObject($ownerVisibility, $companyVisibility,);

        $this->assertTrue($createdRole instanceof RoleInterface);
        $this->assertDatabaseHas(
            Role::TABLE,
            [
                Role::ID => $role->getId(),
                Role::COMPANY_VISIBILITY => $companyVisibility,
                Role::OWNER_VISIBILITY => $ownerVisibility,
            ]
        );
    }
}
