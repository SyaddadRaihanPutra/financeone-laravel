<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function getApi()
    {
        $userId = auth()->id(); // Mendapatkan ID pengguna yang sedang login

        // Total income dan expense
        $totalIncome = Transaction::where('user_id', $userId)
            ->where('type', 'income')
            ->sum('amount');

        $totalExpense = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->sum('amount');

        // Total balance
        $totalBalance = $totalIncome - $totalExpense;

        // Ambil data transaksi untuk 7 hari terakhir
        $seriesData = Transaction::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw("SUM(CASE WHEN type = 'income' THEN amount ELSE 0 END) as total_income"),
            DB::raw("SUM(CASE WHEN type = 'expense' THEN amount ELSE 0 END) as total_expense")
        )
            ->where('user_id', $userId)
            ->where('created_at', '>=', now()->subDays(3))  // Menyesuaikan untuk mengambil data 7 hari terakhir
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get()
            ->map(function ($item) {
                return [
                    'date' => $item->date,
                    'total_income' => $item->total_income,
                    'total_expense' => $item->total_expense,
                ];
            });

        // Mendapatkan tanggal-tanggal selama 7 hari terakhir
        $dates = collect();
        for ($i = 2; $i >= 0; $i--) {
            $dates->push(Carbon::today()->subDays($i)->toDateString());
        }

        // Menggabungkan data transaksi dengan tanggal yang tidak ada datanya
        $completeData = $dates->map(function ($date) use ($seriesData) {
            $existingData = $seriesData->firstWhere('date', $date);
            return [
                'date' => $date,
                'total_income' => $existingData ? $existingData['total_income'] : 0,
                'total_expense' => $existingData ? $existingData['total_expense'] : 0,
            ];
        });

        // Handle jika data yang dicari masih kosong
        if ($completeData->isEmpty()) {
            return response()->json([
                'message' => 'No data available for the specified period.',
                'totalBalance' => 0,
                'totalIncome' => 0,
                'totalExpense' => 0,
                'seriesData' => [],
            ]);
        }

        return response()->json([
            'totalBalance' => $totalBalance,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'seriesData' => $completeData, // Kirim data lengkap
        ]);
    }

}
