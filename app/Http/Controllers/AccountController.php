<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class AccountController extends Controller
{
    // Display a listing of the accounts
    public function index()
    {
        $accounts = Account::all();
        return view('accounts.index', compact('accounts'));
    }

    // Show the form for creating a new account
    public function create()
    {
        return view('accounts.create');
    }

    // Store a newly created account in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Account::create($request->all());

        return redirect()->route('accounts.index')->with('success', 'account created successfully.');
    }

    // Show the form for editing a specific account
    public function edit(Account $account)
    {
        return view('accounts.edit', compact('account'));
    }

    // Update a specific account in the database
    public function update(Request $request, Account $account)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $account->update($request->all());

        return redirect()->route('accounts.index')->with('success', 'account updated successfully.');
    }

    // Delete a specific account from the database
    public function destroy(Account $account)
    {
        $account->delete();

        return redirect()->route('accounts.index')->with('success', 'account deleted successfully.');
    }
}
