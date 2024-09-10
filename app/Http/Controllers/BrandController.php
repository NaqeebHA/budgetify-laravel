<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('brands.index', compact('brands'));
    }

    // Show the form for creating a new brand
    public function create()
    {
        return view('brands.create');
    }

    // Store a newly created brand in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Brand::create($request->all());

        return redirect()->route('brands.index')->with('success', 'brand created successfully.');
    }

    // Show the form for editing a specific brand
    public function edit(Brand $brand)
    {
        return view('brands.edit', compact('brand'));
    }

    // Update a specific brand in the database
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $brand->update($request->all());

        return redirect()->route('brands.index')->with('success', 'brand updated successfully.');
    }

    // Delete a specific brand from the database
    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect()->route('brands.index')->with('success', 'brand deleted successfully.');
    }
}
