<?php

namespace App\Listeners;

use App\Events\ContactSubmissionEvent;
use App\Mail\ContactNotificationMail;
use App\Models\ContactNotificationReceiver;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ContactSubmissionListener implements ShouldQueue
{
    public function handle(ContactSubmissionEvent $event): void {
        foreach (ContactNotificationReceiver::all() as $receiver) {
            Mail::to($receiver->user_id ? $receiver->user->email : $receiver->email)
                ->send(new ContactNotificationMail($event->submission));
        }
    }
}
