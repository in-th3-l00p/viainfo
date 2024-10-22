<?php

namespace Database\Seeders\Classroom;

use App\Models\Classroom\Classroom;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Classroom::all() as $classroom) {
            $students = User::query()
                ->where("role", "=", "student")
                ->whereHas(
                    "classroomInvitations",
                    function ($query) use ($classroom) {
                        $query->whereNot("classroom_id", $classroom->id);
                    })
                ->inRandomOrder()
                ->limit(rand(1, 10))
                ->get();
            $classroom
                ->users()
                ->attach($students, ["role" => "student"]);

            $teachers = User::query()
                ->where("role", "=", "admin")
                ->inRandomOrder()
                ->limit(rand(1, 3))
                ->get();
            $classroom
                ->users()
                ->attach($teachers, ["role" => "teacher"]);
        }
    }
}
