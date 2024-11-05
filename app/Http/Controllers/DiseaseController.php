<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disease;

class DiseaseController extends Controller
{
    public function index()
    {
        $diseases = Disease::all(); 
        return view('healthAtoZ.index', compact('diseases'));
    }

    public function viewUser()
    {
        $diseases = Disease::all(); // Fetch all diseases
        return view('healthAtoZ.patientDisease', compact('diseases'));
    }

    public function create()
    {
        return view('healthAtoZ.create'); // Show form for creating a new disease
    }

    public function store(Request $request)
    {
        // Validate and store the new disease
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Disease::create($request->all());
        return redirect()->route('diseases.index')->with('success', 'Disease created successfully.');
    }

    public function show($id)
    {
        $disease = Disease::findOrFail($id); // Fetch the specific disease
        return view('healthAtoZ.show', compact('disease'));
    }

    public function edit($id)
    {
        $disease = Disease::findOrFail($id); // Fetch the disease for editing
        return view('healthAtoZ.edit', compact('disease'));
    }

    public function update(Request $request, $id)
    {
        // Validate and update the disease
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $disease = Disease::findOrFail($id);
        $disease->update($request->all());
        return redirect()->route('diseases.index')->with('success', 'Disease updated successfully.');
    }

    public function destroy($id)
    {
        $disease = Disease::findOrFail($id);
        $disease->delete();
        return redirect()->route('diseases.index')->with('success', 'Disease deleted successfully.');
    }
}