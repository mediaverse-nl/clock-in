<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'deveron reniers',
            'email' => 'deveron.reniers@gmail.com',
            'password' => bcrypt('admin'),
            'business_id' => array_rand(\App\Business::all()->pluck('id', 'id')->toArray(),  1),
            'hourly_rate' => 10.50,
        ]);

        $faker = Faker::create();

        foreach (range(1,10) as $index) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('admin'),
                'business_id' => array_rand(\App\Business::all()->pluck('id', 'id')->toArray(),  1),
                'hourly_rate' => 10.50,
            ]);
        }
    }
}
