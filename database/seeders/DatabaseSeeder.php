<?php

namespace Database\Seeders;

use App\Models\Classroom\Classroom;
use App\Models\Contact\ContactSubmission;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'test@example.com',
            'role' => 'admin'
        ]);

        $user = User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com'
        ]);

        User::factory(30)->create();

        $xii = Classroom::factory()->create([
            'name' => 'xii',
            'slug' => 'xii',
            'owner_id' => 1
        ]);
        $xi = Classroom::factory()->create([
            'name' => 'xi',
            'slug' => 'xi',
            'owner_id' => 1
        ]);

        $xii->invitedUsers()->attach($user);

        ContactSubmission::factory(15)->create();
    }
}
