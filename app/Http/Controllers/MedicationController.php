<?php

namespace App\Http\Controllers;

use App\Models\Medication;
use Illuminate\Http\Request;
use App\Models\User;

class MedicationController extends Controller
{
    public function index()
    {
        $medications = Medication::with('supplier')->get();
        return view('medications.index', compact('medications'));
    }

    public function show($id)
{
    $medication = Medication::findOrFail($id);
    return view('medications.show', compact('medication'));
}

    public function create()
    {
        $suppliers = User::where('role', 'drug_supplier')->get();
        return view('medications.create',compact('suppliers')); 
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'supplier_id' => 'required|exists:users,id',
        'price' => 'required|numeric|min:0',
        'stock_quantity' => 'required|integer|min:0',
    ]);
    
    Medication::create([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'supplier_id' => $request->input('supplier_id'),
        'price' => $request->input('price'),
        'stock_quantity' => $request->input('stock_quantity'),
    ]);

    return redirect()->route('medications.index')->with('success', 'Medication added successfully.');
}


    public function edit(Medication $medication)
    {
        $suppliers = User::where('role', 'drug_supplier')->get();
        return view('medications.edit', compact('medication','suppliers')); // Show the form for editing the medication
    }

    public function update(Request $request, Medication $medication)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'supplier_id' => 'required|exists:users,user_id',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
        ]);

        $medication->update($request->all());

        return redirect()->route('medications.index')->with('success', 'Medication updated successfully.');
    }

    public function destroy(Medication $medication)
    {
        $medication->delete();

        return redirect()->route('medications.index')->with('success', 'Medication deleted successfully.');
    }

    public function view()
    {
        $medications = Medication::all();
        return view('medications.view', compact('medications'));
    }

}