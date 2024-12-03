<?php

namespace Tests\Unit\Http\Controllers\Admin\Classrooms\Events;

use App\Http\Controllers\Admin\Classrooms\Events\ClassroomEventController;
use App\Models\Classroom\Classroom;
use App\Models\Classroom\ClassroomEvent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ClassroomEventControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->classroom = Classroom::factory()->create();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    #[Test]
    public function test_create()
    {
        Gate::shouldReceive('authorize')->once()->andReturn(true);
        $response = $this->get(route('admin.classrooms.events.create', $this->classroom));
        $response->assertStatus(200);
        $response->assertViewIs('admin.classrooms.events.create');
    }

    #[Test]
    public function testStore()
    {
        Gate::shouldReceive('authorize')->once()->andReturn(true);
        $data = [
            'name' => 'Test Event',
            'description' => 'Test Description',
            'start' => now()->addDay(),
            'end' => now()->addDays(2),
            'self_attend' => true,
        ];
        $response = $this->post(route('admin.classrooms.events.store', $this->classroom), $data);
        $response->assertRedirect(route('admin.classrooms.show', $this->classroom));
        $this->assertDatabaseHas('classroom_events', ['name' => 'Test Event']);
    }

    #[Test]
    public function testEdit()
    {
        $event = ClassroomEvent::factory()->create(['classroom_id' => $this->classroom->id]);
        Gate::shouldReceive('authorize')->once()->andReturn(true);
        $response = $this->get(route('admin.classrooms.events.edit', [$this->classroom, $event]));
        $response->assertStatus(200);
        $response->assertViewIs('admin.classrooms.events.edit');
    }

    #[Test]
    public function testUpdate()
    {
        $event = ClassroomEvent::factory()->create(['classroom_id' => $this->classroom->id]);
        Gate::shouldReceive('authorize')->once()->andReturn(true);
        $data = [
            'name' => 'Updated Event',
            'description' => 'Updated Description',
            'start' => now()->addDay(),
            'end' => now()->addDays(2),
            'self_attend' => true,
        ];
        $response = $this->put(route('admin.classrooms.events.update', [$this->classroom, $event]), $data);
        $response->assertRedirect(route('admin.classrooms.show', $this->classroom));
        $this->assertDatabaseHas('classroom_events', ['name' => 'Updated Event']);
    }

    #[Test]
    public function testUpdateSelfAttendTrue()
    {
        $event = ClassroomEvent::factory()->create(['classroom_id' => $this->classroom->id, 'self_attend' => false, 'attend_code' => null]);
        Gate::shouldReceive('authorize')->once()->andReturn(true);
        $data = [
            'name' => 'Updated Event',
            'description' => 'Updated Description',
            'start' => now()->addDay(),
            'end' => now()->addDays(2),
            'self_attend' => true,
        ];
        $response = $this->put(route('admin.classrooms.events.update', [$this->classroom, $event]), $data);
        $response->assertRedirect(route('admin.classrooms.show', $this->classroom));
        $this->assertDatabaseHas('classroom_events', ['id' => $event->id, 'self_attend' => true]);
        $this->assertDatabaseMissing('classroom_events', ['id' => $event->id, 'attend_code' => null]);
        $this->assertTrue(strlen(ClassroomEvent::find($event->id)->attend_code) === 6);
    }

    #[Test]
    public function testUpdateSelfAttendFalse()
    {
        $event = ClassroomEvent::factory()->create(['classroom_id' => $this->classroom->id, 'self_attend' => true, 'attend_code' => Str::random(6)]);
        Gate::shouldReceive('authorize')->once()->andReturn(true);
        $data = [
            'name' => 'Updated Event',
            'description' => 'Updated Description',
            'start' => now()->addDay(),
            'end' => now()->addDays(2),
            'self_attend' => false,
        ];
        $response = $this->put(route('admin.classrooms.events.update', [$this->classroom, $event]), $data);
        $response->assertRedirect(route('admin.classrooms.show', $this->classroom));
        $this->assertDatabaseHas('classroom_events', ['id' => $event->id, 'self_attend' => false, 'attend_code' => null]);
    }

    #[Test]
    public function testDelete()
    {
        $event = ClassroomEvent::factory()->create(['classroom_id' => $this->classroom->id]);
        Gate::shouldReceive('authorize')->once()->andReturn(true);
        $response = $this->get(route('admin.classrooms.events.delete', [$this->classroom, $event]));
        $response->assertStatus(200);
        $response->assertViewIs('admin.classrooms.events.delete');
    }

    #[Test]
    public function testDestroy()
    {
        $event = ClassroomEvent::factory()->create(['classroom_id' => $this->classroom->id]);
        Gate::shouldReceive('authorize')->once()->andReturn(true);
        $response = $this->delete(route('admin.classrooms.events.destroy', [$this->classroom, $event]));
        $response->assertRedirect(route('admin.classrooms.show', $this->classroom));
        $this->assertSoftDeleted('classroom_events', ['id' => $event->id]);
    }

    #[Test]
    public function testTrash()
    {
        $event = ClassroomEvent::factory()->create(['classroom_id' => $this->classroom->id]);
        $event->delete();
        Gate::shouldReceive('authorize')->once()->andReturn(true);
        $response = $this->get(route('admin.classrooms.events.trash', $this->classroom));
        $response->assertStatus(200);
        $response->assertViewIs('admin.classrooms.events.trash');
    }

    #[Test]
    public function testRestore()
    {
        $event = ClassroomEvent::factory()->create(['classroom_id' => $this->classroom->id]);
        $event->delete();
        Gate::shouldReceive('authorize')->once()->andReturn(true);
        $response = $this->post(route('admin.classrooms.events.restore', [$this->classroom, $event]));
        $response->assertRedirect(route('admin.classrooms.show', $this->classroom));
        $this->assertDatabaseHas('classroom_events', ['id' => $event->id, 'deleted_at' => null]);
    }

    #[Test]
    public function testCreateUnauthorized()
    {
        Gate::shouldReceive('authorize')->once()->andReturn(false);
        $response = $this->get(route('admin.classrooms.events.create', $this->classroom));
        $response->assertStatus(403);
    }

    #[Test]
    public function testStoreUnauthorized()
    {
        Gate::shouldReceive('authorize')->once()->andReturn(false);
        $data = [
            'name' => 'Test Event',
            'description' => 'Test Description',
            'start' => now()->addDay(),
            'end' => now()->addDays(2),
            'self_attend' => true,
        ];
        $response = $this->post(route('admin.classrooms.events.store', $this->classroom), $data);
        $response->assertStatus(403);
    }

    #[Test]
    public function testEditUnauthorized()
    {
        $event = ClassroomEvent::factory()->create(['classroom_id' => $this->classroom->id]);
        Gate::shouldReceive('authorize')->once()->andReturn(false);
        $response = $this->get(route('admin.classrooms.events.edit', [$this->classroom, $event]));
        $response->assertStatus(403);
    }

    #[Test]
    public function testUpdateUnauthorized()
    {
        $event = ClassroomEvent::factory()->create(['classroom_id' => $this->classroom->id]);
        Gate::shouldReceive('authorize')->once()->andReturn(false);
        $data = [
            'name' => 'Updated Event',
            'description' => 'Updated Description',
            'start' => now()->addDay(),
            'end' => now()->addDays(2),
            'self_attend' => true,
        ];
        $response = $this->put(route('admin.classrooms.events.update', [$this->classroom, $event]), $data);
        $response->assertStatus(403);
    }

    #[Test]
    public function testDeleteUnauthorized()
    {
        $event = ClassroomEvent::factory()->create(['classroom_id' => $this->classroom->id]);
        Gate::shouldReceive('authorize')->once()->andReturn(false);
        $response = $this->get(route('admin.classrooms.events.delete', [$this->classroom, $event]));
        $response->assertStatus(403);
    }

    #[Test]
    public function testDestroyUnauthorized()
    {
        $event = ClassroomEvent::factory()->create(['classroom_id' => $this->classroom->id]);
        Gate::shouldReceive('authorize')->once()->andReturn(false);
        $response = $this->delete(route('admin.classrooms.events.destroy', [$this->classroom, $event]));
        $response->assertStatus(403);
    }

    #[Test]
    public function testTrashUnauthorized()
    {
        $event = ClassroomEvent::factory()->create(['classroom_id' => $this->classroom->id]);
        $event->delete();
        Gate::shouldReceive('authorize')->once()->andReturn(false);
        $response = $this->get(route('admin.classrooms.events.trash', $this->classroom));
        $response->assertStatus(403);
    }

    #[Test]
    public function testRestoreUnauthorized()
    {
        $event = ClassroomEvent::factory()->create(['classroom_id' => $this->classroom->id]);
        $event->delete();
        Gate::shouldReceive('authorize')->once()->andReturn(false);
        $response = $this->post(route('admin.classrooms.events.restore', [$this->classroom, $event]));
        $response->assertStatus(403);
    }
}
