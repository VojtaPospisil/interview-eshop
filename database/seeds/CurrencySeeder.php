<?php

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = array(
           array(
            'currency_code' => 'CZK',
            'currency_value' => 0.0
        ),
            array(
                'currency_code' => 'EUR',
                'currency_value' => 26.0
            )
        );

        DB::table('currencies')->insert($data);
//        DB::table('currencies')->insert([
//            'currency_code' => 'CZK',
//            'currency_value' => 0.0
//        ], [
//            'currency_code' => 'EUR',
//            'currency_value' => 26.0
//        ]);
    }
}
