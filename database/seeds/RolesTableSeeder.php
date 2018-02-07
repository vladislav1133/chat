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

        config(['permission.cache_expiration_time' => '0']);

        Permission::create(['name' => 'ban user']);
        Permission::create(['name' => 'mute user']);

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo('ban user');
        $adminRole->givePermissionTo('mute user');

        Permission::create(['name' => 'can watch']);
        Permission::create(['name' => 'can write']);

        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo('can write');
        $userRole->givePermissionTo('can watch');

        $watcherRole = Role::create(['name' => 'watcher']);
        $watcherRole->givePermissionTo('can watch');

        $blockedUser = Role::create(['name' => 'blockedUser']);


    }
}
