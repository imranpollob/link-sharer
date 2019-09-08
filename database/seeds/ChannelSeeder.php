<?php

use App\Channel;
use Illuminate\Database\Seeder;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel::create([
            'name' => 'PHP',
            'slug' => 'php',
            'color' => '#4d588f'
        ]);

        Channel::create([
            'name' => 'JavaScript',
            'slug' => 'javascript',
            'color' => '#e9d54d'
        ]);

        Channel::create([
            'name' => 'Laravel',
            'slug' => 'laravel',
            'color' => '#ed615c'
        ]);


    }
}
