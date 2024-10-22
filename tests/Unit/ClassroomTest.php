<?php

namespace Tests\Unit;

use App\Models\Classroom\Classroom;
use App\Models\User;
use App\Models\Classroom\ClassroomTag;
use App\Models\Classroom\ClassroomEvent;
use Database\Seeders\User\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function PHPUnit\Framework\assertNotNull;

class ClassroomTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(UserSeeder::class);
    }

    #[Test]
    public function test_classroom_creation()
    {
        $owner = User::query()->where("role", "admin")->first();
        $classroom = Classroom::create([
            'name' => 'Test Classroom',
            'slug' => 'test-classroom',
            'description' => 'A description',
            'owner_id' => $owner->id,
        ]);

        $this->assertDatabaseHas('classrooms', [
            'name' => 'Test Classroom',
            'slug' => 'test-classroom',
            'description' => 'A description',
        ]);
    }

    #[Test]
    public function test_classroom_owner_relationship()
    {
        $admin = User::query()->where("role", "admin")->first();
        assertNotNull($admin);
        $classroom = Classroom::factory()->create(['owner_id' => $admin->id]);

        $this->assertTrue($classroom->owner->is($admin));
    }

    #[Test]
    public function test_classroom_students_relationship()
    {
        $classroom = Classroom::factory()->create();
        $user = User::query()->where("role", "user")->first();
        assertNotNull($user);
        $classroom->users()->attach($user, ['role' => 'student']);

        $this->assertTrue($classroom->users->contains($user));
    }

    #[Test]
    public function test_classroom_teachers_relationship()
    {
        $classroom = Classroom::factory()->create();
        $teacher = User::query()->where("role", "admin")->first();
        assertNotNull($teacher);
        $classroom->users()->attach($teacher, ['role' => 'teacher']);

        $this->assertTrue($classroom->teachers->contains($teacher));
    }

    #[Test]
    public function test_classroom_invited_users_relationship()
    {
        $classroom = Classroom::factory()->create();
        $user = User::factory()->create();
        $classroom->invitedUsers()->attach($user);

        $this->assertTrue($classroom->invitedUsers->contains($user));
    }

    #[Test]
    public function test_classroom_events_relationship()
    {
        $classroom = Classroom::factory()->create();
        $classroom->users()->attach(
            User::query()->where("role", "admin")->first(),
            [ "role" => "teacher" ]
        );
        $event = ClassroomEvent::factory()->create(['classroom_id' => $classroom->id]);
        $this->assertTrue($classroom->events->contains($event));
    }
}
