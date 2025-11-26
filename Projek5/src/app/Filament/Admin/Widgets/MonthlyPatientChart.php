<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\LineChartWidget;
use App\Models\Transaction;
use App\Models\Diagnosa;
use Illuminate\Support\Carbon;

class MonthlyPatientChart extends LineChartWidget
{
    protected static ?string $heading = 'Jumlah Pasien Terlayani per Bulan';

    protected function getData(): array
    {
        $labels = [];
        $values = [];

        foreach (range(1, 12) as $month) {
            $monthName = Carbon::create()->month($month)->translatedFormat('F');

            // Ambil semua appointment_id dari transaksi Lunas
            $transactionAppointments = Transaction::where('status', 'Lunas')
                ->whereMonth('created_at', $month)
                ->pluck('appointment_id')
                ->toArray();

            // Ambil semua appointment_id dari diagnosa Sudah Diperiksa
            $diagnosaAppointments = Diagnosa::where('status', 'Sudah Diperiksa')
                ->whereMonth('created_at', $month)
                ->pluck('appointment_id')
                ->toArray();

            // Gabungkan & hilangkan duplikat appointment_id
            $uniqueAppointments = collect(array_merge($transactionAppointments, $diagnosaAppointments))
                ->unique()
                ->count();

            $labels[] = $monthName;
            $values[] = $uniqueAppointments;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pasien Terlayani',
                    'data' => $values,
                    'borderColor' => '#3b82f6', // biru
                    'backgroundColor' => 'rgba(59, 130, 246, 0.3)',
                    'tension' => 0.4,
                ],
            ],
            'labels' => $labels,
        ];
    }
}
