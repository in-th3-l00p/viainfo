<?php

namespace App\Models;

use App\Mail\InvitationMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

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

    public function send() {
        $this->update([
            "sent" => true,
        ]);
        Mail::to($this->email)
            ->send(new InvitationMail($this));
    }
}
