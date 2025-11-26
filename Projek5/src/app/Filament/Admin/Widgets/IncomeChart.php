<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\LineChartWidget;
use App\Models\Transaction;
use Illuminate\Support\Carbon;

class IncomeChart extends LineChartWidget
{
    protected static ?string $heading = 'Grafik Pemasukan Bulanan';

    protected function getData(): array
    {
        // Ambil semua transaksi lunas
        $transactions = Transaction::where('status', 'Lunas')->get();

        // Kelompokkan berdasarkan bulan (format angka 01, 02, dst)
        $monthlyTotals = $transactions->groupBy(function ($transaction) {
            return Carbon::parse($transaction->created_at)->format('m');
        });

        // Siapkan label dan nilai pemasukan per bulan
        $labels = [];
        $values = [];

        foreach (range(1, 12) as $month) {
            $monthKey = str_pad($month, 2, '0', STR_PAD_LEFT); // "01", "02", dst.
            $monthName = Carbon::create()->month($month)->translatedFormat('F'); // Nama bulan

            $labels[] = $monthName;
            $values[] = isset($monthlyTotals[$monthKey])
                ? (int) $monthlyTotals[$monthKey]->sum('amount') // Buang desimal
                : 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Pemasukan',
                    'data' => $values,
                    'borderColor' => '#4ade80', // warna garis hijau
                    'backgroundColor' => 'rgba(74, 222, 128, 0.2)',
                    'tension' => 0.4, // smooth line
                ],
            ],
            'labels' => $labels,
        ];
    }
}
