<?php

use Illuminate\Database\Seeder;

class EmployeeDummySeeder extends Seeder {
    
    public function run() {
        DB::table('employees')->delete();
        DB::table('employees')->insert([
            'name' => 'Montana Iles',
            'department' => 'Admin',
            'position' => 'Admin Associate',
        ]);
        DB::table('employees')->insert([
            'name' => 'Demi-Lee Figueroa',
            'department' => 'Digital Marketing',
            'position' => 'Creative Writer',
        ]);
        DB::table('employees')->insert([
            'name' => 'Emilia Dalton',
            'department' => 'Human Resources',
            'position' => 'HR Associate',
        ]);
        DB::table('employees')->insert([
            'name' => 'Aurora Parkinson',
            'department' => 'Human Resources',
            'position' => 'HR Assistant',
        ]);
        DB::table('employees')->insert([
            'name' => 'Sidney Sheridan',
            'department' => 'IT',
            'position' => 'IT Support',
        ]);
           DB::table('employees')->insert([
            'name' => 'Brandon-Lee Obrien',
            'department' => 'Security',
            'position' => 'Security Officer',
        ]);DB::table('employees')->insert([
            'name' => 'Harry Paul',
            'department' => 'Web Development',
            'position' => 'Web Developer',
        ]);
    }
}