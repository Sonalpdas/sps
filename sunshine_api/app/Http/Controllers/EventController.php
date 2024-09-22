<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

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
