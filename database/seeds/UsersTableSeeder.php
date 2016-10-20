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
            'name' => 'Mubashar Ahmed Hassan',
            'email' => 'admin@check.com',
            'password' => bcrypt('123456'),
            'role' => 'admin'
        ]);
    }
}
