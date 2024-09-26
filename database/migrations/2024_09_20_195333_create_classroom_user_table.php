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
        Schema::create('classroom_user', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->enum('role', ['student', 'teacher'])
                ->default('student');
            $table->foreignIdFor(Classroom::class)
                ->constrained("classrooms")
                ->onDelete('cascade');
            $table->foreignIdFor(User::class)
                ->constrained("users")
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classroom_user');
    }
};
