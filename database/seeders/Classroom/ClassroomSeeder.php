<?php

namespace Database\Seeders\Classroom;

use App\Models\Classroom\Classroom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    public function run(): void
    {
        Classroom::factory()->create([
            'name' => 'xii',
            'slug' => 'xii',
        ]);
        Classroom::factory()->create([
            'name' => 'xi',
            'slug' => 'xi',
        ]);

        $this->call([
            InvitationSeeder::class,
            MemberSeeder::class
        ]);

        Classroom::factory()->create([
            'name' => 'Empty',
            'slug' => 'empty',
        ]);
    }
}
