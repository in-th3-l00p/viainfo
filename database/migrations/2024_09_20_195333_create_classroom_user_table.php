<?php

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
            $table->foreignId('classroom_id')
                ->constrained("classrooms")
                ->onDelete('cascade');
            $table->foreignId('user_id')
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
