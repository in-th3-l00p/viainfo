<?php

namespace App\Models\Classroom;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassroomTag extends Model
{
    use HasFactory;

    protected $fillable = [
        "name"
    ];

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class);
    }
}
