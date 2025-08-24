<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    // Display listing of the guests 
     
    public function index()
    {
        $guests = Guest::orderBy('id', 'asc')->paginate(10); // 10 per page
        return view('guests.index', compact('guests'));
    }

    
    //   Show 
    
    public function create()
    {
        return view('guests.create');
    }

    
    //   Store 
     
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => ['required', 'regex:/^[a-zA-Z\s]+$/', 'min:3', 'max:255'], 
            'email' => 'required|email|unique:guests,email',
            'phone' => ['required', 'regex:/^\+?[0-9\s\-()]{7,20}$/'], 
            'address' => 'required|string|max:500',
            'id_proof_type' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'max:255'], 
            'id_proof_number' => 'required|alpha_num|max:255',
            'id_proof_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'emergency_contact_name' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'max:255'],
            'emergency_contact_phone' => ['required', 'regex:/^\+?[0-9\s\-()]{7,20}$/'],
            'special_requests' => 'nullable|string|max:1000',
        ], [
            'name.regex' => 'The guest name may only contain letters and spaces.',
            'name.min' => 'The guest name must be at least 3 characters long.',
            'id_proof_type.regex' => 'The ID proof type may only contain letters and spaces.',
            'emergency_contact_name.regex' => 'The emergency contact name may only contain letters and spaces.',
            'phone.regex' => 'Please enter a valid phone number.',
            'emergency_contact_phone.regex' => 'Please enter a valid emergency contact number.',
            'id_proof_number.alpha_num' => 'The ID proof number may only contain letters and numbers.',
        ]);

    if ($request->hasFile('id_proof_image')) {
        $validated['id_proof_image'] = $request->file('id_proof_image')->store('id_proofs', 'public');
    }

        Guest::create($validated);

        return redirect()->route('guests.index')->with('success', 'Guest created successfully.');
    }

    
    //   editing 
     
    public function edit(Guest $guest)
    {
        return view('guests.edit', compact('guest'));
    }

    
    //   Update
     
    public function update(Request $request, Guest $guest)
    {
        $validated = $request->validate([
            'name'  => ['required', 'regex:/^[a-zA-Z\s]+$/', 'min:3', 'max:255'], 
            'email' => 'required|email|unique:guests,email,' . $guest->id,
            'phone' => ['required', 'regex:/^\+?[0-9\s\-()]{7,20}$/'], 
            'address' => 'required|string|max:500',
            'id_proof_type' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'max:255'], 
            'id_proof_number' => 'required|alpha_num|max:255',
            'id_proof_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'emergency_contact_name' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'max:255'],
            'emergency_contact_phone' => ['required', 'regex:/^\+?[0-9\s\-()]{7,20}$/'],
            'special_requests' => 'nullable|string|max:1000',
        ], [
            'name.regex' => 'The guest name may only contain letters and spaces.',
             'name.min' => 'The guest name must be at least 3 characters long.',
            'id_proof_type.regex' => 'The ID proof type may only contain letters and spaces.',
            'emergency_contact_name.regex' => 'The emergency contact name may only contain letters and spaces.',
            'phone.regex' => 'Please enter a valid phone number.',
            'emergency_contact_phone.regex' => 'Please enter a valid emergency contact number.',
            'id_proof_number.alpha_num' => 'The ID proof number may only contain letters and numbers.',
        ]);


    if ($request->hasFile('id_proof_image')) {
        $validated['id_proof_image'] = $request->file('id_proof_image')->store('id_proofs', 'public');
    }

        $guest->update($validated);

        return redirect()->route('guests.index')->with('success', 'Guest updated successfully.');
    }

     //   show
   
    public function show(Guest $guest)
    {
        return view('guests.show', compact('guest'));
    }
    
    //   delete
     
    public function destroy(Guest $guest)
    {
        $guest->delete();

        return redirect()->route('guests.index')->with('success', 'Guest deleted successfully.');
    }
}