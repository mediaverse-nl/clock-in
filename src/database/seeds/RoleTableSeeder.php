<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'value' => 'user',
            ],[
                'value' => 'manager',
            ],[
                'value' => 'admin',
            ],[
                'value' => 'Super Admin'
            ]
        ]);

    }
}
