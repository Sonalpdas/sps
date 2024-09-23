<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Mail\ContactActionMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class ContactController extends Controller
{
    // List all contacts
    public function index()
    {
        return Contact::all();
    }

    // Add a new contact
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:32',
            'last_name' => 'required|string|max:32',
            'email' => 'required|email',
            'phone' => 'required|string|max:16',
            'reason' => 'required|string|max:32',
        ]);

        // Create the contact
        $contact = Contact::create($validatedData);

        try {
            // Attempt to send the email to the user
            Mail::to($contact->email)->send(new ContactActionMail('added', $contact, 'user'));

            // Attempt to send the email to the organization
            Mail::to('support@sunshinepreschool1-2.org')->send(new ContactActionMail('added', $contact, 'organization'));

        } catch (\Exception $e) {
            // Log the error and allow the process to continue
            Log::error('Email failed to send: ' . $e->getMessage());
        }


        return response()->json($contact, 201);
    }

    // Update a contact
    public function update(Request $request, $id)
    {
        // Find the contact by ID or fail
        $contact = Contact::findOrFail($id);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:32',
            'last_name' => 'required|string|max:32',
            'email' => 'required|email|unique:contacts,email,' . $id,  // Ensure unique email excluding current record
            'phone' => 'required|string|max:16',
            'reason' => 'required|string|max:32',
        ]);

        // Update the contact with the validated data
        $contact->update($validatedData);

        // Return the updated contact data
        return response()->json($contact);
    }

    // Delete a contact
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return response()->json(null, 204);
    }
}
