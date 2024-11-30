<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = auth()->user()->reports()->latest()->paginate(10);
        return view('reports.index', compact('reports'));
    }

    public function generate()
    {
        // Fetch data for the report
        $transactions = auth()->user()->transactions()->get();
        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $netBalance = $totalIncome - $totalExpense;

        // Create report data
        $reportData = [
            'total_income' => $totalIncome,
            'total_expense' => $totalExpense,
            'net_balance' => $netBalance,
            'transactions' => $transactions,
        ];

        // Save report in the database
        auth()->user()->reports()->create([
            'data' => json_encode($reportData),
            'generated_date' => now(),
        ]);

        return redirect()->route('reports.index')->with('success', 'Report generated successfully.');
    }

    public function show(Report $report)
    {
        $this->authorize('view', $report);
        $reportData = json_decode($report->data, true);
        return view('reports.show', compact('reportData'));
    }
}
