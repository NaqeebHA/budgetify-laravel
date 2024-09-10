<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApparelType;

class ApparelTypeController extends Controller
{
    public function index()
    {
        $apparelTypes = ApparelType::all();
        return view('apparel-types.index', compact('apparelTypes'));
    }

    // Show the form for creating a new apparelType
    public function create()
    {
        return view('apparel-types.create');
    }

    // Store a newly created apparelType in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        ApparelType::create($request->all());

        return redirect()->route('apparel-types.index')->with('success', 'apparel type created successfully.');
    }

    // Show the form for editing a specific apparelType
    public function edit(ApparelType $apparelType)
    {
        return view('apparel-types.edit', compact('apparelType'));
    }

    // Update a specific apparelType in the database
    public function update(Request $request, ApparelType $apparelType)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $apparelType->update($request->all());

        return redirect()->route('apparel-types.index')->with('success', 'apparel type updated successfully.');
    }

    // Delete a specific apparelType from the database
    public function destroy(ApparelType $apparelType)
    {
        $apparelType->delete();

        return redirect()->route('apparel-types.index')->with('success', 'apparel type deleted successfully.');
    }
}
