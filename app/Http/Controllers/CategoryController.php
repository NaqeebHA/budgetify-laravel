<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // Show the form for creating a new category
    public function create()
    {
        return view('categories.create');
    }

    // Store a newly created category in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'in_out' => 'required',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'category created successfully.');
    }

    // Show the form for editing a specific category
    public function edit(category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Update a specific category in the database
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'in_out' => 'required',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'category updated successfully.');
    }

    // Delete a specific category from the database
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'category deleted successfully.');
    }

    public function getCategoriesInOut($in_out)
    {
        $categories = Category::where('in_out', $in_out)->get();

        return response()->json($categories);
    }
}
