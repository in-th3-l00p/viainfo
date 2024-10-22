<?php

namespace Database\Seeders;

use App\Models\Classroom\Classroom;
use App\Models\Contact\ContactSubmission;
use App\Models\User;
use Database\Seeders\Classroom\ClassroomSeeder;
use Database\Seeders\User\UserSeeder;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ContactSeeder::class,
            UserSeeder::class,
            ClassroomSeeder::class
        ]);
    }
}
