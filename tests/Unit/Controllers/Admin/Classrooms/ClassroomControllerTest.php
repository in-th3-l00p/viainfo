<?php

namespace Tests\Unit\Controllers\Admin\Classrooms;

use App\Models\Classroom\Classroom;
use App\Models\User;
use Database\Seeders\User\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ClassroomControllerTest extends TestCase
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
    public function test_index()
    {
        $response = $this->get(route('admin.classrooms.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.classrooms.index');
    }

    #[Test]
    public function test_create()
    {
        $response = $this->get(route('admin.classrooms.create'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.classrooms.create');
    }

    #[Test]
    public function test_store_valid_input()
    {
        $response = $this->post(route('admin.classrooms.store'), [
            'name' => 'Test Classroom',
            'slug' => 'test-classroom',
            'description' => 'A description',
        ]);

        $response->assertRedirect(route('admin.classrooms.show', Classroom::first()));
        $this->assertDatabaseHas('classrooms', [
            'name' => 'Test Classroom',
            'slug' => 'test-classroom',
            'description' => 'A description',
        ]);
    }

    #[Test]
    public function test_store_invalid_input()
    {
        $response = $this->post(route('admin.classrooms.store'), [
            'name' => '',
            'slug' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'slug']);
    }

    #[Test]
    public function test_store_name_and_slug_uniqueness() {
        $classroom = Classroom::factory()->create(['owner_id' => $this->admin->id]);
        $response = $this->post(route('admin.classrooms.store'), [
            'name' => $classroom->name,
            'slug' => $classroom->slug,
        ]);
        $response->assertSessionHasErrors(['name', 'slug']);
    }

    #[Test]
    public function test_show()
    {
        $classroom = Classroom::factory()->create(['owner_id' => $this->admin->id]);
        $response = $this->get(route('admin.classrooms.show', $classroom));
        $response->assertStatus(200);
        $response->assertViewIs('admin.classrooms.show');
    }

    #[Test]
    public function test_update_valid_input()
    {
        $classroom = Classroom::factory()->create(['owner_id' => $this->admin->id]);
        $response = $this->put(route('admin.classrooms.update', $classroom), [
            'name' => 'Updated Classroom',
            'slug' => 'updated-classroom',
            'description' => 'Updated description',
        ]);

        $response->assertRedirect(route('admin.classrooms.show', $classroom));
        $this->assertDatabaseHas('classrooms', [
            'name' => 'Updated Classroom',
            'slug' => 'updated-classroom',
            'description' => 'Updated description',
        ]);
    }

    #[Test]
    public function test_update_invalid_input()
    {
        $classroom = Classroom::factory()->create(['owner_id' => $this->admin->id]);
        $response = $this->put(route('admin.classrooms.update', $classroom), [
            'name' => '',
            'slug' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'slug']);
    }

    #[Test]
    public function test_update_name_and_slug_uniqueness() {
        $classroom = Classroom::factory()->create(['owner_id' => $this->admin->id]);
        $response = $this->put(route('admin.classrooms.update', $classroom), [
            'name' => $classroom->name,
            'slug' => $classroom->slug,
        ]);
        $response->assertRedirect();

        $classroom2 = Classroom::factory()->create(['owner_id' => $this->admin->id]);
        $response = $this->put(route('admin.classrooms.update', $classroom), [
            'name' => $classroom2->name,
            'slug' => $classroom->slug,
        ]);
        $response->assertSessionHasErrors(['name']);
        $response = $this->put(route('admin.classrooms.update', $classroom), [
            'name' => $classroom->name,
            'slug' => $classroom2->slug,
        ]);
        $response->assertSessionHasErrors(['slug']);
    }

    #[Test]
    public function test_delete()
    {
        $classroom = Classroom::factory()->create(['owner_id' => $this->admin->id]);
        $response = $this->get(route('admin.classrooms.delete', $classroom));
        $response->assertStatus(200);
        $response->assertViewIs('admin.classrooms.delete');
    }

    #[Test]
    public function test_destroy()
    {
        $classroom = Classroom::factory()->create(['owner_id' => $this->admin->id]);
        $response = $this->delete(route('admin.classrooms.destroy', $classroom));
        $response->assertRedirect(route('admin.classrooms.index'));
        $this->assertSoftDeleted($classroom);
    }

    #[Test]
    public function test_trash()
    {
        $response = $this->get(route('admin.classrooms.trash'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.classrooms.trash');
    }

    #[Test]
    public function test_restore()
    {
        $classroom = Classroom::factory()->create(['owner_id' => $this->admin->id]);
        $classroom->delete();
        $response = $this->put(route('admin.classrooms.restore', $classroom));
        $response->assertRedirect(route('admin.classrooms.show', $classroom));
        $this->assertDatabaseHas('classrooms', ['id' => $classroom->id, 'deleted_at' => null]);
    }
}
