<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = ['admin', 'users', 'publisher', 'writer'];

        $default = [
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ];

        foreach ($users as $value) {
            User::create([...$default, ...[
                'username' => $value,
                'name' => $value,
                'email' => $value . '@example.com'
            ]])->assignRole($value);
        }
    }
}
