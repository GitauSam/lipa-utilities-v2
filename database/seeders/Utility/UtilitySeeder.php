<?php

namespace Database\Seeders\Utility;

use Illuminate\Database\Seeder;
use App\Models\Utility\Utility;
use App\Models\Utility\UtilityPaymentMethod;

class UtilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // DB::table('utilities')->insert([
        //     'utility_name' => 'Electricity',
        //     'status' => 1,
        // ]);

        $utility = Utility::create([
            'utility_name' => 'Electricity',
            'status' => 1,
        ]);

        UtilityPaymentMethod::create([
            'utility_id' => $utility->id,
            'payment_method_name' => 'M-Pesa',
            'lipa_na_mpesa_paybill' => '174379',
            'status' => 1,
        ]);

    }
}
