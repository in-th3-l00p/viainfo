<?php

namespace Tests\Unit\Factories\Users\Classrooms;

use App\Models\Classroom\Classroom;
use App\Models\Classroom\ClassroomEvent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Unit\Factories\Users\Test;
use function PHPUnit\Framework\assertNotEmpty;

class ClassroomEventFactoryTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_classroom_event_factory()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $classroom = Classroom::factory()->create();
        $classroom->users()->attach($user, [ "role" => "teacher" ]);
        assertNotEmpty($classroom->teachers);

        // Generate a ClassroomEvent instance using the factory
        $classroomEvent = ClassroomEvent::factory()->create();

        // Assert the ClassroomEvent instance is valid
        $this->assertInstanceOf(ClassroomEvent::class, $classroomEvent);

        // Assert the ClassroomEvent has valid relationships and attributes
        $this->assertEquals($classroom->id, $classroomEvent->classroom_id);
        $this->assertEquals($user->id, $classroomEvent->owner_id);
        $this->assertNotNull($classroomEvent->name);
        $this->assertNotNull($classroomEvent->description);
        $this->assertNotNull($classroomEvent->start);
        $this->assertNotNull($classroomEvent->end);
        $this->assertNotNull($classroomEvent->attend_code);
    }
}
