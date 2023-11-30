<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Kelvin Chui',
            'email' => 'chuikelvin2@gmail.com',
            'password' => Hash::make('1234'),
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
