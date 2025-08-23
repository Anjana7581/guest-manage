<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    // Display listing of the guests 
     
    public function index()
    {
        $guests = Guest::latest()->paginate(10); // 10 per page
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
            'email' => 'nullable|email|unique:guests,email',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'id_proof_type' => 'nullable|string|max:255',
            'id_proof_number' => 'nullable|string|max:255',
            'id_proof_image' => 'nullable|string|max:255',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:255',
            'special_requests' => 'nullable|string',
        ]);

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
            'email' => 'nullable|email|unique:guests,email,' . $guest->id,
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'id_proof_type' => 'nullable|string|max:255',
            'id_proof_number' => 'nullable|string|max:255',
            'id_proof_image' => 'nullable|string|max:255',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:255',
            'special_requests' => 'nullable|string',
        ]);

        $guest->update($validated);

        return redirect()->route('guests.index')->with('success', 'Guest updated successfully.');
    }

    
    //   delete
     
    public function destroy(Guest $guest)
    {
        $guest->delete();

        return redirect()->route('guests.index')->with('success', 'Guest deleted successfully.');
    }
}