<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Transaction;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function index()
    {
        $budgets = auth()->user()->budgets;

        return view('budgets.index', compact('budgets'));
    }


    public function create()
    {
        return view('budgets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'type' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        auth()->user()->budgets()->create($request->all());
        return redirect()->route('budgets.index')->with('success', 'Budget added successfully.');
    }

    public function edit(Budget $budget)
    {
        $this->authorize('update', $budget);
        return view('budgets.edit', compact('budget'));
    }

    public function update(Request $request, Budget $budget)
    {
        $this->authorize('update', $budget);

        $request->validate([
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $budget->update($request->all());
        return redirect()->route('budgets.index')->with('success', 'Budget updated successfully.');
    }

    public function destroy(Budget $budget)
    {
        $this->authorize('delete', $budget);
        $budget->delete();
        return redirect()->route('budgets.index')->with('success', 'Budget deleted successfully.');
    }
}
