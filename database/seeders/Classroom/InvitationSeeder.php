<?php

namespace Database\Seeders\Classroom;

use App\Models\Classroom\Classroom;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvitationSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Classroom::all() as $classroom) {
            $students = User::query()
                ->where("role", "=", "student")
                ->inRandomOrder()
                ->limit(rand(1, 5))
                ->get();
            $classroom
                ->invitedUsers()
                ->attach($students);
        }
    }
}
