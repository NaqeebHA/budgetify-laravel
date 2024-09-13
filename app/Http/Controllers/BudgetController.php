<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use App\Services\BudgetService;
use App\Http\Requests\StoreBudgetRequest;
use App\Http\Requests\UpdateBudgetRequest;

class BudgetController extends Controller
{
    protected $budgetService;

    public function __construct(BudgetService $budgetService)
    {
        $this->budgetService = $budgetService;
    }

    public function index()
    {
        $budgets = $this->budgetService->getAllBudgets();
        return view('budgets.index', compact('budgets'));
    }

    // Show the form for creating a new budget
    public function create()
    {
        $dropdowns = $this->budgetService->budgetDropdowns();
        return view('budgets.create', $dropdowns);
    }

    // Store a newly created budget in the database
    public function store(StoreBudgetRequest $request)
    {
        $this->budgetService->addbudget($request);
        return redirect()->route('budgets.index')->with('success', 'Budget added successfully.');
    }

    // Show the form for editing a specific budget
    public function edit(Budget $budget)
    {
        $dropdowns = $this->budgetService->budgetDropdowns();
        return view('budgets.edit', compact('budget'), $dropdowns);
    }

    // Update a specific budget in the database
    public function update(UpdateBudgetRequest $request, Budget $budget)
    {
        $this->budgetService->updateBudgetByRequest($request, $budget);
        return redirect()->route('budgets.index')->with('success', 'Budget updated successfully.');
    }

    // Delete a specific budget from the database
    public function destroy(Budget $budget)
    {
        $this->budgetService->deleteBudget($budget);
        return redirect()->route('budgets.index')->with('success', 'Budget deleted successfully.');
    }

    // Delete an attachment from the budget
    public function deleteAttachment(Budget $budget)
    {
        $this->budgetService->deleteBudgetAttachment($budget);
        return response()->json(['success' => 'Attachment deleted successfully.']);
    }

    public function analyticsByCategory(Request $request)
    {
        $in_out = $request->query('in_out');
        $date_from = $request->query('from');
        $date_to = $request->query('to');

        $budgets = $this->budgetService->analyticsByCategory($in_out, $date_from, $date_to);
        return response()->json($budgets);
    }

    public function analyticsByAccount(Request $request)
    {
        $in_out = $request->query('in_out');
        $date_from = $request->query('from');
        $date_to = $request->query('to');

        $budgets = $budgets = $this->budgetService->analyticsByAccount($in_out, $date_from, $date_to);
        return response()->json($budgets);
    }
}
