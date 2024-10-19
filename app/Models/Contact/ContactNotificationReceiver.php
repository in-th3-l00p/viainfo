<?php

namespace App\Models\Contact;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactNotificationReceiver extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "name",
        "email"
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
