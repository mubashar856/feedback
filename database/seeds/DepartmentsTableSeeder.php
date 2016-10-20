<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'department_name' => 'Computer Science',
            'department_logo' => 'default.png',
            'slug' => 'computer-science'
        ]);

        DB::table('departments')->insert([
            'department_name' => 'Electrical',
            'department_logo' => 'default.png',
            'slug' => 'electrical'
        ]);
    }
}
