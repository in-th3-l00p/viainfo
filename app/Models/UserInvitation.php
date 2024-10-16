<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInvitation extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "email",
        "token",
        "invited_by",
        "sent",
    ];

    public function inviter() {
        return $this->belongsTo(User::class, "invited_by");
    }
}
