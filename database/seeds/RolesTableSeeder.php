<?php

use Illuminate\Database\Seeder;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Bouncer::ability()->create(['name' => 'visit-page', 'title' => 'Visit page']);
        Bouncer::ability()->create(['name' => 'write-message', 'title' => 'Write message']);

        Bouncer::role()->create(['name' => 'admin', 'title' => 'Administrator']);

        Bouncer::allow('admin')->everything();


    }
}
