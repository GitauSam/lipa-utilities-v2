<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
           // DB::table('users')->insert([
        //     'name' => 'John Doe',
        //     'email' => 'tricky49er@gmail.com',
        //     'phone_number' => '254736423077',
        //     'password' => Hash::make('JohnDoe1234'),
        //     'email_verified_at' => now()
        // ]);

        $userOne = User::create([
            'name' => 'John Doe',
            'email' => 'tricky49er@gmail.com',
            'phone_number' => '254746820652',
            'password' => Hash::make('JohnDoe1234')
        ]);

        $userOne->assignRole('user');

        $userTwo = User::create([
            'name' => 'June Doe',
            'email' => 'junedoe@gmail.com',
            'phone_number' => '254712121212',
            'password' => Hash::make('JuneDoe1234'),
            'email_verified_at' => now()
        ]);

        $userTwo->assignRole('user');

        $userThree = User::create([
            'name' => 'Joy Doe',
            'email' => 'joydoe@gmail.com',
            'phone_number' => '254713131313',
            'password' => Hash::make('JoyDoe1234'),
            'email_verified_at' => now()
        ]);

        $userThree->assignRole('user');

        $mod = User::create([
            'name' => 'Jane Doe',
            'email' => 'mod@lipautilities.com',
            'phone_number' => '254123456789',
            'password' => Hash::make('JaneDoe1234'),
            'email_verified_at' => now()
        ]);

        $mod->assignRole('moderator');

        $superAdmin = User::create([
            'name' => 'Jack Doe',
            'email' => 'superadmin@lipautilities.com',
            'phone_number' => '254987654321',
            'password' => Hash::make('JackDoe1234'),
            'email_verified_at' => now()
        ]);

        $superAdmin->assignRole('super-admin');

    }
}
