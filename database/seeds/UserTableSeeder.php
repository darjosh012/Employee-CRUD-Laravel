<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {
    
    public function run() {
        DB::table('users')->delete();
        DB::table('users')->insert([
            'name' => 'Daryll Magsombol',
            'nickname' => 'Daryll',
            'email' => 'darjosh012@gmail.com',
            'password' => Hash::make('pogiako123'),
        ]);
        DB::table('users')->insert([
            'name' => 'Hector Wiggins',
            'nickname' => 'Hector',
            'email' => 'hector@gmail.com',
            'password' => Hash::make('hector123'),
        ]);
    }
}