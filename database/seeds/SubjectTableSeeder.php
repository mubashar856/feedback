<?php

use Illuminate\Database\Seeder;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            'subject_name' => 'Electronics',
            'subject_logo' => 'default.png',
            'slug' => 'electronics'
        ]);
        DB::table('subjects')->insert([
            'subject_name' => 'Web Engineering',
            'subject_logo' => 'default.png',
            'slug' => 'web-engineering'
        ]);
        DB::table('subjects')->insert([
            'subject_name' => 'Earth',
            'subject_logo' => 'default.png',
            'slug' => 'earth'
        ]);
    }
}
