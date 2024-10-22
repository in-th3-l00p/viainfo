<?php

namespace Database\Seeders;

use App\Models\Contact\ContactSubmission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactSubmission::factory(15)->create();
    }
}
