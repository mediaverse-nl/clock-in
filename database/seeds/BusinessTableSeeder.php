<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BusinessTableSeeder extends Seeder
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

            DB::table('business')->insert([
                'name' => $faker->name,
                'coc_nr' => $faker->ean8,
                'vat_nr' => $this->bigNumber(),
                'bank_name' => $faker->name,
                'bank_iban' => $faker->bankAccountNumber,
                'address' => $faker->streetName,
                'address_nr' => $faker->buildingNumber,
                'postal_code' => $faker->postcode,
                'place' => $faker->city,
                'country' => $faker->country,
            ]);

        }
    }

    function bigNumber() {
        # prevent the first number from being 0
        $output = rand(1,9);

        for($i=0; $i < 7; $i++) {
            $output .= rand(0,9);
        }

        return $output;
    }
}
