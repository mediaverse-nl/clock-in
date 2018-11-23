<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::get();

        foreach ($users as $user) {
            DB::table('user_roles')->insert([
                'user_id' => $user->id,
                'role_id' => 1,
            ]);
        }

        DB::table('user_roles')->insert([
            'user_id' => 1,
            'role_id' => 2,
        ]);
        DB::table('user_roles')->insert([
            'user_id' => 1,
            'role_id' => 3,
        ]);
        DB::table('user_roles')->insert([
            'user_id' => 1,
            'role_id' => 4,
        ]);
    }
}
