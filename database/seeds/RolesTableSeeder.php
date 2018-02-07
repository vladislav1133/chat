<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');



        Permission::create(['name' => 'ban user']);
        Permission::create(['name' => 'mute user']);
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo('ban user');
        $adminRole->givePermissionTo('mute user');

        Permission::create(['name' => 'can watch']);
        Permission::create(['name' => 'can write']);
        $useRole = Role::create(['name' => 'user']);
        $useRole->givePermissionTo('can write');
        $useRole->givePermissionTo('can watch');

    }
}
