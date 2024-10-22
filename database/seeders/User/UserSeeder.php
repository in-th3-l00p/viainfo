<?php

namespace Database\Seeders\User;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);
        $user = User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com'
        ]);

        User::factory(5)
            ->admin()
            ->create();
        User::factory(30)->create();
    }
}
