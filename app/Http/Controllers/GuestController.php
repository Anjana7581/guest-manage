<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    // Display listing of the guests 
     
    public function index()
    {
        $guests = Guest::latest()->paginate(6); // 10 per page
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
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:guests,email',
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
            'id_proof_type' => 'required|string|max:255',
            'id_proof_number' => 'required|string|max:255',
            'id_proof_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:255',
            'special_requests' => 'nullable|string',
        ],  [
            'name.required' => 'Please enter the guest name.',
            'name.max' => 'Name cannot exceed 255 characters.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'phone.max' => 'Phone number cannot exceed 255 characters.',
            '*.max' => 'The :attribute cannot exceed 255 characters.',
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
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:guests,email,' . $guest->id,
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
            'id_proof_type' => 'required|string|max:255',
            'id_proof_number' => 'required|string|max:255',
            'id_proof_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:255',
            'special_requests' => 'nullable|string',
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