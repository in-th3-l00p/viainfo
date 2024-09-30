<?php

use App\Models\Classroom\Classroom;
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
        Schema::create('classroom_events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->string("name");
            $table->text("description")->nullable();
            $table->dateTime("start")->nullable();
            $table->dateTime("end")->nullable();

            $table
                ->foreignIdFor(Classroom::class)
                ->constrained("classrooms")
                ->onDelete("cascade");
            $table
                ->foreignIdFor(User::class, "owner_id")
                ->constrained("users")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
