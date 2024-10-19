<?php

use App\Models\Classroom\ClassroomEvent;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('classroom_event_attendances', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table
                ->foreignIdFor(ClassroomEvent::class)
                ->constrained("classroom_events")
                ->onDelete('cascade');
            $table
                ->foreignIdFor(User::class)
                ->constrained("users")
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classroom_event_attendences');
    }
};
