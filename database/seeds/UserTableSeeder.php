<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {
    
    public function run() {
        DB::table('users')->delete();
        DB::table('users')->insert([
            'name' => 'Daryll Magsombol',
            'username' => 'daryllmagsombol',
            'email' => 'darjosh012@gmail.com',
            'password' => Hash::make('pogiako123'),
        ]);
    }
}