<?php

namespace App\Models\Classroom;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassroomEvent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name",
        "description",
        "start",
        "end",
        "self_attend",
        "attend_code",
        "owner_id",
        "classroom_id"
    ];

    /**
     * Get the owner of the event.
     * @return BelongsTo : The owner of the event.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, "owner_id");
    }

    /**
     * Get the classroom of the event.
     * @return BelongsTo : The classroom of the event.
     */
    public function classroom() {
        return $this->belongsTo(Classroom::class);
    }

    /**
     * Get the attendances of the event.
     * @return BelongsToMany : The attendances of the event.
     */
    public function attendances(): BelongsToMany
    {
        return $this
            ->belongsToMany(User::class, "classroom_event_attendances")
            ->withTimestamps();
    }
}
