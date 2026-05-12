<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate([
            'email' => 'admin@gorent.test',
        ], [
            'id' => (string) Str::uuid(),
            'name' => 'Super Admin',
            'phone' => '+628111111111',
            'password' => Hash::make('password'),
        ]);

        $admin->assignRole('admin');
    }
}