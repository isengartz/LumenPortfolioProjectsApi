<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create random records
        factory(\App\ProjectTag::class,4)->create();
        factory(\App\Project::class,4)->create();
        // $this->call('UsersTableSeeder');
    }
}
