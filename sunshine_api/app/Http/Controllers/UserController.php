<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\UserActionMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    // List all users
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // Add a new user
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Hash the password before storing
        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);
        
        try {
            // Send email to the user
            Mail::to($user->email)->send(new UserActionMail('added', $user, 'user'));

            // Send email to the organization
            Mail::to('support@sunshinepreschool1-2.org')->send(new UserActionMail('added', $user, 'organization'));

        } catch (\Exception $e) {
            // Log the error and allow the process to continue
            Log::error('Email failed to send: ' . $e->getMessage());
        }              

        return response()->json($user, 201);  // HTTP 201 Created
    }

    // Update an existing user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
        ]);

        // Update the password only if it's provided
        if ($request->has('password')) {
            $validatedData['password'] = Hash::make($request->password);
        }

        $user->update($validatedData);

        return response()->json($user);
    }

    // Delete a user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
