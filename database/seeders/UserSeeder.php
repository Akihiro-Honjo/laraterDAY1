<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'イチロー',
            'email' => 'test51@test.com',
            'password' => Hash::make('password'),
          ]);
          User::create([
            'name' => 'サブロー',
            'email' => 'test03@test.com',
            'password' => Hash::make('password'),
          ]);
          User::create([
            'name' => 'ゴロー',
            'email' => 'test56@test.com',
            'password' => Hash::make('password'),
          ]);
    }
}
