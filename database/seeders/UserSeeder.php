<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'jhon',
            'email' => 'jhon@example.com',
            'password' => Hash::make('11223344'), // Ganti dengan password yang diinginkan
        ]);
    }
}
