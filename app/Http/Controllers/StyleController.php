<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Style;

class StyleController extends Controller
{
    public function index()
    {
        $styles = Style::all();
        return view('styles.index', compact('styles'));
    }

    // Show the form for creating a new style
    public function create()
    {
        return view('styles.create');
    }

    // Store a newly created style in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Style::create($request->all());

        return redirect()->route('styles.index')->with('success', 'style created successfully.');
    }

    // Show the form for editing a specific style
    public function edit(Style $style)
    {
        return view('styles.edit', compact('style'));
    }

    // Update a specific style in the database
    public function update(Request $request, Style $style)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $style->update($request->all());

        return redirect()->route('styles.index')->with('success', 'style updated successfully.');
    }

    // Delete a specific style from the database
    public function destroy(Style $style)
    {
        $style->delete();

        return redirect()->route('styles.index')->with('success', 'style deleted successfully.');
    }
}
