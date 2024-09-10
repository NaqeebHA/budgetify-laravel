<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\Category;
use App\Models\Account;
use Illuminate\Support\Facades\Storage;

class BudgetController extends Controller
{
    public function index()
    {
        $budgets = Budget::all();
        return view('budgets.index', compact('budgets'));
    }

    // Show the form for creating a new budget
    public function create()
    {
        $accounts = Account::all();
        return view('budgets.create', compact('accounts'));
    }

    // Store a newly created budget in the database
    public function store(Request $request)
    {
        $request->validate([
            'in_out' => 'required',
            'amount' => 'required',
            'note' => 'nullable',
            'description' => 'nullable',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,jfif,gif|max:2048',
            'txn_datetime' => 'required',
            'category_id' => 'required',
            'account_id' => 'required',
        ]);

        $created_budget = Budget::create($request->all());

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $path = $file->store('budget-attachments', 'public');
            $created_budget->attachment = $path;
            $created_budget->save();
        }
        return redirect()->route('budgets.index')->with('success', 'budget created successfully.');
    }

    // Show the form for editing a specific budget
    public function edit(Budget $budget)
    {
        $accounts = Account::all();
        return view('budgets.edit', compact(['budget','accounts']));
    }

    // Update a specific budget in the database
    public function update(Request $request, Budget $budget)
    {
        $request->validate([
            'in_out' => 'required',
            'amount' => 'required',
            'note' => 'nullable',
            'description' => 'nullable',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,jfif,gif|max:2048',
            'txn_datetime' => 'required',
            'category_id' => 'required',
            'account_id' => 'required',
        ]);

        if ($request->hasFile('attachment')) {
            if ($budget->attachment ?? false) {
                Storage::delete('public/' . $budget->attachment);
                $budget->update($request->all());
            }
            $file = $request->file('attachment');
            $path = $file->store('budget-attachments', 'public');
            $budget->attachment = $path;
            $budget->save();
        } else {
            $budget->update($request->all());
        }
        return redirect()->route('budgets.index')->with('success', 'budget updated successfully.');
    }

    // Delete a specific budget from the database
    public function destroy(Budget $budget)
    {
        $budget->delete();

        return redirect()->route('budgets.index')->with('success', 'budget deleted successfully.');
    }

    // Delete an attachment from the budget
    public function deleteAttachment(Budget $budget)
    {
        Storage::delete('public/' . $budget->attachment);
        $budget->attachment = null;
        $budget->save();

        return response()->json(['success' => 'attachment deleted successfully.']);
    }
}
