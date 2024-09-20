<?php

namespace App\Models\Classroom;

use App\Models\User;
use Illuminate\Container\Attributes\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public function owner() {
        return $this->belongsTo(User::class, "owner_id");
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, "classroom_tag");
    }
}
