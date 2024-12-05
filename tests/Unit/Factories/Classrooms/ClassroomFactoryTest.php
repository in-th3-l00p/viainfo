<?php

namespace Tests\Unit\Factories\Users\Classrooms;

use App\Models\Classroom\Classroom;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Unit\Factories\Users\Test;

class ClassroomFactoryTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_classroom_factory()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        assert(User::query()->where("role", "admin")->count() > 0);
        $classroom = Classroom::factory()->create();
        $this->assertInstanceOf(Classroom::class, $classroom);

        $this->assertEquals($admin->id, $classroom->owner_id);
        $this->assertNotNull($classroom->name);
        $this->assertNotNull($classroom->slug);
        $this->assertNotNull($classroom->description);
    }
}
