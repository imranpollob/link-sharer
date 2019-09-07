<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Imran Pollob',
            'email' => 'polboy777@gmail.com',
            'password' => '$2y$10$S4UQR35e/eq5yNeT5ctkueuh.8wltb/lgz/LAP05Ge9v3ys8iabo6'
        ]);

        User::create([
            'name' => 'Tanjila Priety',
            'email' => 'tanjila.tanji15@gmail.com',
            'password' => '$2y$10$S4UQR35e/eq5yNeT5ctkueuh.8wltb/lgz/LAP05Ge9v3ys8iabo6'
        ]);
    }
}
