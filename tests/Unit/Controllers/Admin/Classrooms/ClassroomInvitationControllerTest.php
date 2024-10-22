<?php

namespace Tests\Unit\Controllers\Admin\Classrooms;

use App\Models\Classroom\Classroom;
use App\Models\User;
use Database\Seeders\User\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClassroomInvitationControllerTest extends TestCase
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
    public function test_destroy_valid_invitation()
    {
        $classroom = Classroom::factory()->create(['owner_id' => $this->admin->id]);
        $teacher = User::query()->where("role", "admin")->first();
        $classroom->users()->attach($teacher, ["role" => "teacher"]);
        $user = User::factory()->create(['role' => 'user']);
        $classroom->invitedUsers()->attach($user);

        $response = $this->delete(route('admin.classrooms.invitations.destroy', [
            'classroom' => $classroom->id,
            'user' => $user->id,
        ]));

        $response->assertSessionHas("success");
        $response->assertRedirect();
        $this->assertDatabaseMissing('classroom_user', [
            'classroom_id' => $classroom->id,
            'user_id' => $user->id,
        ]);
    }

    #[Test]
    public function test_destroy_invalid_invitation()
    {
        $classroom = Classroom::factory()->create(['owner_id' => $this->admin->id]);
        $teacher = User::query()->where("role", "admin")->first();
        $classroom->users()->attach($teacher, ["role" => "teacher"]);
        $user = User::query()
            ->where("role", "user")
            ->first();

        $response = $this->delete(route('admin.classrooms.invitations.destroy', [
            'classroom' => $classroom->id,
            'user' => $user->id,
        ]));
        $this->assertEmpty($classroom->invitedUsers()->get());
        $response->assertSessionHasErrors("user");
    }

    #[Test]
    public function test_destroy_non_admin_user()
    {
        $classroom = Classroom::factory()->create(['owner_id' => $this->admin->id]);
        $teacher = User::query()->where("role", "admin")->first();
        $classroom->users()->attach($teacher, ["role" => "teacher"]);
        $user = User::query()
            ->where("role", "user")
            ->inRandomOrder()
            ->first();
        $classroom->invitedUsers()->attach($user);

        $nonAdmin = User::query()->where("role", "user")->first();
        $this->actingAs($nonAdmin);

        $response = $this->delete(route('admin.classrooms.invitations.destroy', [
            'classroom' => $classroom->id,
            'user' => $user->id,
        ]));

        $response->assertStatus(403);
    }
}
