<?php

namespace App\Services;

use App\Models\Budget;
use App\Models\Category;
use App\Models\Account;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreBudgetRequest;
use App\Http\Requests\UpdateBudgetRequest;

class BudgetService
{
    public function getAllBudgets()
    {
        return Budget::all();
    }

    public function findBudgetById($id)
    {
        return Budget::find($id);
    }

    public function updateBudget($id, array $data)
    {
        $budget = Budget::find($id);

        if ($budget) {
            return $budget->update($data);
        }

        return false;
    }

    public function updateBudgetByRequest(UpdateBudgetRequest $request, Budget $budget)
    {
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
    }

    public function budgetDropdowns()
    {
        $accounts = Account::all();
        return ['accounts' => $accounts];
    }

    public function addBudget(StoreBudgetRequest $request)
    {
        $created_budget = Budget::create($request->all());

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $path = $file->store('budget-attachments', 'public');
            $created_budget->attachment = $path;
            $created_budget->save();
        }
    }

    public function deleteBudget(Budget $budget)
    {
        $budget->delete();
    }

    public function deleteBudgetAttachment(Budget $budget)
    {
        Storage::delete('public/' . $budget->attachment);
        $budget->attachment = null;
        $budget->save();
    }

    public function analyticsByCategory($in_out,  $date_from, $date_to)
    {
        $budgets = Budget::select('categories.name AS category', DB::raw('SUM(budgets.amount) AS total'))
        ->leftJoin('categories', 'budgets.category_id', '=', 'categories.id')
        ->whereBetween('budgets.txn_datetime', [$date_from . ' 00:00:00', $date_to . ' 23:59:59'])
        ->where('budgets.in_out', '=', $in_out)
        ->groupBy('categories.name')
        ->get();
        return $budgets;
    }

    public function analyticsByAccount($in_out,  $date_from, $date_to)
    {
        $budgets = Budget::select('accounts.name AS account', DB::raw('SUM(budgets.amount) AS total'))
        ->leftJoin('accounts', 'budgets.account_id', '=', 'accounts.id')
        ->whereBetween('budgets.txn_datetime', [$date_from . ' 00:00:00', $date_to . ' 23:59:59'])
        ->where('budgets.in_out', '=', $in_out)
        ->groupBy('account')
        ->get();
        return $budgets;
    }

    // public function incomeExpenseByAccount($in_out,  $date_from, $date_to)
    // {
    //     $budgets = Budget::select('accounts.name AS account', DB::raw('SUM(budgets.amount) AS total'))
    //     ->leftJoin('accounts', 'budgets.account_id', '=', 'accounts.id')
    //     ->whereBetween('budgets.txn_datetime', [$date_from . ' 00:00:00', $date_to . ' 23:59:59'])
    //     ->where('budgets.in_out', '=', $in_out)
    //     ->groupBy('account')
    //     ->get();
    //     return $budgets;
    // }
}
