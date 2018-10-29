<?php

use Illuminate\Database\Seeder;

class UserRoleTableSeeder extends Seeder
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

            DB::table('user_roles')->insert([
//                'user_id' => '',
//                'role_id' => '',
            ]);

        }
    }
}
