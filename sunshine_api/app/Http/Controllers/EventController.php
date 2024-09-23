<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Mail\EventActionMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    // List all events
    public function index()
    {
        $events = Event::all();
        return response()->json($events);
    }

    // Create a new event
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'title' => 'required|string|max:32',
            'description' => 'required|string',
        ]);

        $event = Event::create($validatedData);
        
        try {            
            // Send email to the user
            Mail::to($event->email)->send(new EventActionMail('added', $event, 'user'));

            // Send email to the organization
            Mail::to('support@sunshinepreschool1-2.org')->send(new EventActionMail('added', $event, 'organization'));

        } catch (\Exception $e) {
            // Log the error and allow the process to continue
            Log::error('Email failed to send: ' . $e->getMessage());
        }
        

        return response()->json($event, 201);  // HTTP 201 Created
    }

    // Update an event
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $validatedData = $request->validate([
            'date' => 'required|date',
            'title' => 'required|string|max:32',
            'description' => 'required|string',
        ]);

        $event->update($validatedData);

        return response()->json($event);
    }

    // Delete an event
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json(['message' => 'Event deleted successfully']);
    }
}
