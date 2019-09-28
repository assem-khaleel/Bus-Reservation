<?php

use Illuminate\Database\Seeder;

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
            'name' => 'assem al Jimzawi',
            'email' => 'assem.cs.90@gmail.com@email.com',
            'password' => bcrypt('password'),
            'gender'=>'0'
        ]);
        DB::table('users')->insert([
            'name' => 'bilal al khateeb',
            'email' => 'bilal@email.com',
            'password' => bcrypt('password'),
            'gender'=>'0'

        ]);
    }
}
