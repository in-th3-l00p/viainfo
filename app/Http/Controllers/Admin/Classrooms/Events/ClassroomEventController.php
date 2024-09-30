<?php

namespace App\Http\Controllers\Admin\Classrooms\Events;

use App\Http\Controllers\Controller;
use App\Models\Classroom\Classroom;
use App\Models\ClassroomEvent;
use Illuminate\Http\Request;

class ClassroomEventController extends Controller
{
    public function create(Classroom $classroom)
    {
        // Show form to create an event for the specific classroom
    }

    public function store(Request $request, Classroom $classroom)
    {
        // Store a new event for the specific classroom
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom, ClassroomEvent $event)
    {
        // Show form to edit a specific event for the specific classroom
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom, ClassroomEvent $event)
    {
        // Update a specific event for the specific classroom
    }

    public function delete(Classroom $classroom, ClassroomEvent $event)
    {
        // Show form to delete a specific event for the specific classroom
    }

    public function destroy(Classroom $classroom, ClassroomEvent $event)
    {
        // Remove a specific event for the specific classroom
    }

    public function trash(Classroom $classroom)
    {
        // Show all trashed events for the specific classroom
    }

    public function restore(Classroom $classroom, ClassroomEvent $event)
    {
        // Restore a specific trashed event for the specific classroom
    }
}
