<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Classroom\Classroom;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        "role"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Classrooms created by the user (if admin of course).
     * @return HasMany: User has many classrooms
     */
    public function createdClassrooms(): HasMany {
        return $this
            ->hasMany(Classroom::class, 'owner_id');
    }

    /**
     * Classrooms the user is part of (either as student or teacher).
     * @return BelongsToMany: User has many classrooms
     */
    public function classrooms(): BelongsToMany {
        return $this
            ->belongsToMany(Classroom::class)
            ->withPivot('role')
            ->withTimestamps();
    }

    /**
     * All the pending classroom invitations
     * @return BelongsToMany : pending classroom invitations
     */
    public function classroomInvitations(): BelongsToMany {
        return $this->belongsToMany(Classroom::class, "classroom_invitations");
    }
}
