<?php

namespace App\Http\Controllers\User\Classrooms\Events;

use App\Http\Controllers\Controller;
use App\Models\Classroom\Classroom;
use App\Models\ClassroomEvent;
use Illuminate\Http\Request;

class ClassroomEventController extends Controller
{
    public function attend(
        Request $request,
        Classroom $classroom,
        ClassroomEvent $event
    ) {
        $user = $request->user();
        $event->attendances()->attach($user->id);
        return response()->json([
            'message' => 'You have successfully attended the event.'
        ]);
    }
}
