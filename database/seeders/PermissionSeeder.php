<?php

namespace Database\Seeders;

use App\Constants\PermissionTitle;
use App\Models\User\Permission;
use App\Models\User\Role;
use Illuminate\Database\Seeder;
use ReflectionClass;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $class = new ReflectionClass(PermissionTitle::class);

        foreach ($class->getConstants() as $key =>  $permission) {
            Permission::firstOrCreate([Permission::TITLE => $permission]);
        }
        foreach (Role::all() as $role) {
            $role->permissions()->sync(Permission::all());
        }
    }
}
