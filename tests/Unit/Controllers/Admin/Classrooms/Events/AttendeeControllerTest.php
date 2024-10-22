<?php

namespace Tests\Unit\Controllers\Admin\Classrooms\Events;

use App\Models\Classroom\Classroom;
use App\Models\Classroom\ClassroomEvent;
use App\Models\User;
use Database\Seeders\User\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AttendeeControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(UserSeeder::class);
        $this->admin = User::query()->where("role", "admin")->first();
        $this->actingAs($this->admin);

    }

    #[Test]
    public function test_index_authorized()
    {
        $classroom = Classroom::factory()->create(['owner_id' => $this->admin->id]);
        $classroom->users()->attach($this->admin, ['role' => 'teacher']);
        $event = ClassroomEvent::factory()->create(['classroom_id' => $classroom->id]);
        $response = $this->get(route(
            'admin.classrooms.events.attendees.index',
            [$classroom, $event]
        ));

        $response->assertStatus(200);
        $response->assertViewIs('admin.classrooms.events.attendees.index');
    }

    #[Test]
    public function test_index_unauthorized()
    {
        $classroom = Classroom::factory()->create(['owner_id' => $this->admin->id]);
        $classroom->users()->attach($this->admin, ['role' => 'teacher']);
        $event = ClassroomEvent::factory()->create(['classroom_id' => $classroom->id]);

        $nonAdmin = User::factory()->create(['role' => 'user']);
        $this->actingAs($nonAdmin);

        $response = $this->get(route('admin.classrooms.events.attendees.index', [$classroom, $event]));

        $response->assertStatus(403);
    }

    #[Test]
    public function test_markAsAttended_authorized()
    {
        $classroom = Classroom::factory()->create(['owner_id' => $this->admin->id]);
        $classroom->users()->attach($this->admin, ['role' => 'teacher']);
        $event = ClassroomEvent::factory()->create(['classroom_id' => $classroom->id]);
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->post(route(
            'admin.classrooms.events.attendees.mark-as-attended',
            [$classroom, $event, $user]
        ));

        $response->assertRedirect();
        $this->assertDatabaseHas('classroom_event_attendances', [
            'classroom_event_id' => $event->id,
            'user_id' => $user->id,
        ]);
    }

    #[Test]
    public function test_markAsAttended_unauthorized()
    {
        $classroom = Classroom::factory()->create(['owner_id' => $this->admin->id]);
        $classroom->users()->attach($this->admin, ['role' => 'teacher']);
        $event = ClassroomEvent::factory()->create(['classroom_id' => $classroom->id]);
        $user = User::factory()->create(['role' => 'user']);

        $nonAdmin = User::factory()->create(['role' => 'user']);
        $this->actingAs($nonAdmin);

        $response = $this->post(route(
            'admin.classrooms.events.attendees.mark-as-attended',
            [$classroom, $event, $user]
        ));

        $response->assertStatus(403);
    }

    #[Test]
    public function test_markAsNotAttended_authorized()
    {
        $classroom = Classroom::factory()->create(['owner_id' => $this->admin->id]);
        $classroom->users()->attach($this->admin, ['role' => 'teacher']);
        $event = ClassroomEvent::factory()->create(['classroom_id' => $classroom->id]);
        $user = User::factory()->create(['role' => 'user']);
        $event->attendances()->attach($user);

        $response = $this->delete(route(
            'admin.classrooms.events.attendees.mark-as-not-attended',
            [$classroom, $event, $user]
        ));

        $response->assertRedirect();
        $this->assertDatabaseMissing('classroom_event_attendances', [
            'classroom_event_id' => $event->id,
            'user_id' => $user->id,
        ]);
    }

    #[Test]
    public function test_markAsNotAttended_unauthorized()
    {
        $classroom = Classroom::factory()->create(['owner_id' => $this->admin->id]);
        $classroom->users()->attach($this->admin, ['role' => 'teacher']);
        $event = ClassroomEvent::factory()->create(['classroom_id' => $classroom->id]);
        $user = User::factory()->create(['role' => 'user']);
        $event->attendances()->attach($user);

        $nonAdmin = User::factory()->create(['role' => 'user']);
        $this->actingAs($nonAdmin);

        $response = $this->delete(route(
            'admin.classrooms.events.attendees.mark-as-not-attended',
            [$classroom, $event, $user]
        ));

        $response->assertStatus(403);
    }

    #[Test]
    public function test_showAttendCode_authorized()
    {
        $classroom = Classroom::factory()->create(['owner_id' => $this->admin->id]);
        $classroom->users()->attach($this->admin, ['role' => 'teacher']);
        $event = ClassroomEvent::factory()->create( [
            'classroom_id' => $classroom->id,
            'self_attend' => true
        ]);

        $response = $this->get(route(
            'admin.classrooms.events.attendees.show-attend-code',
            [$classroom, $event]
        ));

        $response->assertStatus(200);
        $response->assertViewIs('admin.classrooms.events.attendees.show-attend-code');
    }

    #[Test]
    public function test_showAttendCode_unauthorized()
    {
        $classroom = Classroom::factory()->create(['owner_id' => $this->admin->id]);
        $classroom->users()->attach($this->admin, ['role' => 'teacher']);
        $event = ClassroomEvent::factory()
            ->create([
                'classroom_id' => $classroom->id,
                'self_attend' => true
            ]);

        $nonAdmin = User::factory()->create(['role' => 'user']);
        $this->actingAs($nonAdmin);

        $response = $this->get(route('admin.classrooms.events.attendees.show-attend-code', [$classroom, $event]));

        $response->assertStatus(403);
    }
}
