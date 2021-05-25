<?php

namespace Database\Seeders;

use Database\Seeders\RolesAndPermissions\RolesAndPermissionsSeeder;
use Database\Seeders\Users\UserSeeder;
use Database\Seeders\Utility\UtilitySeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
            UtilitySeeder::class,
        ]);
    }
}
