<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    // List all tours
    public function index()
    {
        $tours = Tour::all();
        return response()->json($tours);
    }

    // Add a new tour
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:32',
            'last_name' => 'required|string|max:32',
            'email' => 'required|email|max:64',
            'phone' => 'required|string|max:11',
            'child_name' => 'required|string|max:32',
            'program' => 'required|string|max:16',
            'school' => 'required|string|max:16',
            'tour_day' => 'required|string|max:16',
            'tour_time' => 'required|string|max:16',
        ]);

        $tour = Tour::create($validatedData);

        return response()->json($tour, 201);  // HTTP 201 Created
    }

    // Update an existing tour
    public function update(Request $request, $id)
    {
        $tour = Tour::findOrFail($id);

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:32',
            'last_name' => 'required|string|max:32',
            'email' => 'required|email|max:64',
            'phone' => 'required|string|max:11',
            'child_name' => 'required|string|max:32',
            'program' => 'required|string|max:16',
            'school' => 'required|string|max:16',
            'tour_day' => 'required|string|max:16',
            'tour_time' => 'required|string|max:16',
        ]);

        $tour->update($validatedData);

        return response()->json($tour);
    }

    // Delete a tour
    public function destroy($id)
    {
        $tour = Tour::findOrFail($id);
        $tour->delete();

        return response()->json(['message' => 'Tour deleted successfully']);
    }
}
