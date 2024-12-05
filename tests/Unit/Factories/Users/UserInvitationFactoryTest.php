<?php

namespace Tests\Unit\Factories\Users;

use App\Models\UserInvitation;
use Database\Seeders\Classroom\ClassroomSeeder;
use Database\Seeders\User\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserInvitationFactoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(UserSeeder::class);
    }

    #[Test]
    public function test_factory_creates_valid_user_invitation()
    {
        $invitation = UserInvitation::factory()->create();

        $this->assertNotNull($invitation);
        $this->assertDatabaseHas('user_invitations', [
            'id' => $invitation->id,
        ]);
    }

    #[Test]
    public function test_factory_with_classroom_creates_valid_user_invitation()
    {
        $this->seed(ClassroomSeeder::class); // Seed classrooms

        $invitation = UserInvitation::factory()->withClassroom()->create();

        $this->assertNotNull($invitation->classroom_name);
        $this->assertDatabaseHas('user_invitations', [
            'id' => $invitation->id,
            'classroom_name' => $invitation->classroom_name,
        ]);
    }

    #[Test]
    public function test_factory_without_classroom_creates_valid_user_invitation()
    {
        $invitation = UserInvitation::factory()->withoutClassroom()->create();

        $this->assertNull($invitation->classroom_name);
        $this->assertDatabaseHas('user_invitations', [
            'id' => $invitation->id,
            'classroom_name' => null,
        ]);
    }

    #[Test]
    public function test_factory_creates_valid_user_invitation_without_classrooms()
    {
        $invitation = UserInvitation::factory()->create();

        $this->assertNotNull($invitation);
        $this->assertDatabaseHas('user_invitations', [
            'id' => $invitation->id,
        ]);
    }
}
