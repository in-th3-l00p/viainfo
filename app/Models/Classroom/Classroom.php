<?php

namespace App\Models\Classroom;

use App\Models\ClassroomEvent;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name",
        "slug",
        "description",
        "owner_id"
    ];

    /**
     * represented by the owner_id column
     * @return BelongsTo: the owner of the classroom
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, "owner_id");
    }

    /**
     * all the classroom's tags
     * @return BelongsToMany: the tags associated with this classroom
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(ClassroomTag::class);
    }

    /**
     * all the classroom's users (students and teachers)
     * @return BelongsToMany: the users associated with this classroom
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "classroom_user")
            ->withPivot("role as classroomRole")
            ->withTimestamps();
    }

    /**
     * all the classroom's students
     * @return BelongsToMany: the students associated with this classroom
     */
    public function students(): BelongsToMany
    {
        return $this->users()
            ->wherePivot("role", "=", "student");
    }

    /**
     * all the classroom's teachers
     * @return BelongsToMany: the teachers associated with this classroom
     */
    public function teachers(): BelongsToMany
    {
        return $this->users()
            ->wherePivot("role", "=", "teacher");
    }

    /**
     * All the pending invited users
     * @return BelongsToMany : pending invited users
     */
    public function invitedUsers(): BelongsToMany {
        return $this
            ->belongsToMany(User::class, "classroom_invitations")
            ->withPivot("created_at as invited_at")
            ->orderBy("invited_at", "desc");
    }

    /**
     * All the events associated with this classroom
     * @return HasMany : the events associated with this classroom
     */
    public function events(): HasMany
    {
        return $this
            ->hasMany(ClassroomEvent::class)
            ->orderBy("start");
    }
}
