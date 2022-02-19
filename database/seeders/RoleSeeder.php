<?php

namespace Database\Seeders;

use App\Models\LocalizableModel;
use App\Models\Translations\RoleTranslation;
use App\Models\User\Role;
use App\Models\User\User;
use App\Repositories\User\RoleRepository;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.

     * @return void
     */
    public function run(RoleRepository $repository)
    {
        foreach (Role::$customRoles as $customRole) {
            $repository->store(
                [
                    Role::OWNER_VISIBILITY => false,
                    Role::COMPANY_VISIBILITY => false,
                    LocalizableModel::LOCALIZATION_KEY => [
                        [
                            RoleTranslation::LOCALE => 'en',
                            RoleTranslation::TITLE => $customRole
                        ]
                    ]
                ]
            );
        }
        $user = User::first();
        $roleTranslation = RoleTranslation::whereTitleLike(Role::ADMIN_ROLE)->with('role')->first();
        $role = $roleTranslation->role;
        $user->roles()->sync([$role->getId()]);
    }
}
