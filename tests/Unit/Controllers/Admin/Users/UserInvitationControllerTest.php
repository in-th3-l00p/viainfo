<?php

namespace Tests\Unit\Controllers\Admin\Users;

use App\Models\User;
use App\Models\UserInvitation;
use Database\Seeders\User\UserSeeder;
use Database\Seeders\Classroom\ClassroomSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserInvitationControllerTest extends TestCase
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
        $response = $this->get(route('admin.users.invitations.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.users.invitations.index');
    }

    #[Test]
    public function test_create()
    {
        $response = $this->get(route('admin.users.invitations.create'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.users.invitations.create');
    }

    // todo test uploading the csv
    #[Test]
    public function test_store()
    {
        $this->seed(ClassroomSeeder::class);

        $response = $this->post(route('admin.users.invitations.store'), [
            'name' => 'Test User',
            'email' => 'tiscacatalin@gmail.com',
            'classroom' => 'xii',
        ]);

        $response->assertSessionHas("success");
        $response->assertRedirect(route('admin.users.invitations.index'));
        $this->assertDatabaseHas('user_invitations', [
            'email' => 'tiscacatalin@gmail.com',
            'name' => 'Test User',
            'classroom_name' => 'xii',
        ]);
    }

    #[Test]
    public function test_delete()
    {
        $invitation = UserInvitation::factory()->create();

        $response = $this->get(route('admin.users.invitations.delete', [
            'invitation' => $invitation->id,
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.users.invitations.delete');
    }

    #[Test]
    public function test_destroy()
    {
        $invitation = UserInvitation::factory()->create();

        $response = $this->delete(route('admin.users.invitations.destroy', [
            'invitation' => $invitation->id,
        ]));

        $response->assertSessionHas("success");
        $response->assertRedirect(route('admin.users.invitations.index'));
        $this->assertDatabaseMissing('user_invitations', [
            'id' => $invitation->id,
        ]);
    }

    #[Test]
    public function test_batch_delete()
    {
        $invitations = UserInvitation::factory()->count(3)->create();

        $response = $this->get(route('admin.users.invitations.batchDelete', [
            'invitations' => $invitations->pluck('id')->toArray(),
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.users.invitations.batchDelete');
    }

    #[Test]
    public function test_batch_destroy()
    {
        $invitations = UserInvitation::factory()->count(3)->create();

        $response = $this->delete(route('admin.users.invitations.batchDestroy'), [
            'invitations' => $invitations->pluck('id')->toArray(),
        ]);

        $response->assertSessionHas("success");
        $response->assertRedirect(route('admin.users.invitations.index'));
        foreach ($invitations as $invitation) {
            $this->assertDatabaseMissing('user_invitations', [
                'id' => $invitation->id,
            ]);
        }
    }

    #[Test]
    public function test_send()
    {
        $invitation = UserInvitation::factory()->create();

        $response = $this->post(route('admin.users.invitations.send', [
            'invitation' => $invitation->id,
        ]));

        $response->assertSessionHas("success");
        $response->assertRedirect(route('admin.users.invitations.index'));
        $this->assertTrue($invitation->fresh()->sent === 1);
    }

    #[Test]
    public function test_batch_send()
    {
        $invitations = UserInvitation::factory()->count(3)->create();

        $response = $this->post(route('admin.users.invitations.send.batch'), [
            'invitations' => $invitations->pluck('id')->toArray(),
        ]);

        $response->assertSessionHas("success");
        $response->assertRedirect(route('admin.users.invitations.index'));
        foreach ($invitations as $invitation) {
            $this->assertTrue($invitation->fresh()->sent === 1);
        }
    }
}
