<?php

namespace Tests\Unit\Controllers\Admin\Classrooms;

use App\Models\Classroom\Classroom;
use App\Models\User;
use Database\Seeders\User\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ClassroomUserControllerTest extends TestCase
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
    public function test_update_valid_input_authorized()
    {
        $classroom = Classroom::factory()->create(['owner_id' => $this->admin->id]);
        $teacher = User::query()->where("role", "admin")->first();
        $classroom->users()->attach($teacher, ["role" => "teacher"]);

        $response = $this->put(route('admin.classrooms.users.update', [
            'classroom' => $classroom->id,
            'user' => $teacher->id,
        ]), [
            'role' => 'student',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('classroom_user', [
            'classroom_id' => $classroom->id,
            'user_id' => $teacher->id,
            'role' => 'student',
        ]);
    }

    #[Test]
    public function test_update_valid_input_unauthorized()
    {
        $classroom = Classroom::factory()->create(['owner_id' => $this->admin->id]);
        $teacher = User::query()->where("role", "admin")->first();
        $classroom->users()->attach($teacher, ["role" => "teacher"]);

        $nonAdmin = User::query()->where("role", "user")->first();
        $this->actingAs($nonAdmin);

        $response = $this->put(route('admin.classrooms.users.update', [
            'classroom' => $classroom->id,
            'user' => $teacher->id,
        ]), [
            'role' => 'student',
        ]);

        $response->assertStatus(403);
    }

    #[Test]
    public function test_delete_authorized()
    {
        $classroom = Classroom::factory()->create(['owner_id' => $this->admin->id]);
        $teacher = User::query()->where("role", "admin")->first();
        $classroom->users()->attach($teacher, ["role" => "teacher"]);

        $response = $this->get(route('admin.classrooms.users.delete', [
            'classroom' => $classroom->id,
            'user' => $teacher->id,
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.classrooms.users.delete');
    }

    #[Test]
    public function test_delete_unauthorized()
    {
        $classroom = Classroom::factory()->create(['owner_id' => $this->admin->id]);
        $teacher = User::query()->where("role", "admin")->first();
        $classroom->users()->attach($teacher, ["role" => "teacher"]);

        $nonAdmin = User::query()->where("role", "user")->first();
        $this->actingAs($nonAdmin);

        $response = $this->get(route('admin.classrooms.users.delete', [
            'classroom' => $classroom->id,
            'user' => $teacher->id,
        ]));

        $response->assertStatus(403);
    }

    #[Test]
    public function test_destroy_authorized()
    {
        $classroom = Classroom::factory()->create(['owner_id' => $this->admin->id]);
        $teacher = User::query()->where("role", "admin")->first();
        $classroom->users()->attach($teacher, ["role" => "teacher"]);

        $response = $this->delete(route('admin.classrooms.users.destroy', [
            'classroom' => $classroom->id,
            'user' => $teacher->id,
        ]));

        $response->assertRedirect(route('admin.classrooms.show', $classroom));
        $this->assertDatabaseMissing('classroom_user', [
            'classroom_id' => $classroom->id,
            'user_id' => $teacher->id,
        ]);
    }

    #[Test]
    public function test_destroy_unauthorized()
    {
        $classroom = Classroom::factory()->create(['owner_id' => $this->admin->id]);
        $teacher = User::query()->where("role", "admin")->first();
        $classroom->users()->attach($teacher, ["role" => "teacher"]);

        $nonAdmin = User::query()->where("role", "user")->first();
        $this->actingAs($nonAdmin);

        $response = $this->delete(route('admin.classrooms.users.destroy', [
            'classroom' => $classroom->id,
            'user' => $teacher->id,
        ]));

        $response->assertStatus(403);
    }
}
