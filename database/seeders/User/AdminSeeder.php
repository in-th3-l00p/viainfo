<?php

namespace Database\Seeders\User;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()
            ->admin()
            ->create([
                'name' => 'Admin User',
                'email' => 'test@example.com',
            ]);
    }
}
