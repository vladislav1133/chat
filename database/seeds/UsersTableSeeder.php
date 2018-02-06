<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $user = User::create([
            'email' => 'admin@chat.test',
            'name' => 'admin',
            'password' => bcrypt('12345678'),
            'color' => \App\Services\ColorGenerateService::getHex()
        ]);

        $user->assignRole('admin');
    }
}
