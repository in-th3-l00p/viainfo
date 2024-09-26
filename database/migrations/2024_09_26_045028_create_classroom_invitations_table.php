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
        Schema::create('classroom_invitations', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignIdFor(User::class)
                ->constrained("users")
                ->cascadeOnDelete();
            $table
                ->foreignIdFor(Classroom::class)
                ->constrained("classrooms")
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classroom_invitations');
    }
};