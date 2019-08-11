<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1,10) as $index) {

            DB::table('location')->insert([
                'business_id' => array_rand(\App\Business::all()->pluck('id', 'id')->toArray(),  1),
                'address' => $faker->streetName,
                'address_nr' => $faker->buildingNumber,
                'postal_code' => $faker->postcode,
                'place' => $faker->city,
                'country' => $faker->country,
            ]);

        }
    }


}
