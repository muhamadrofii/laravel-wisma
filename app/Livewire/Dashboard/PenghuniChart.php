<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Penginapan;

class Penghunichart extends Component
{
    public $labels = [];         // Nama-nama penginapan
    public $data = [];           // Data jumlah booking per penginapan per minggu
    public $weeklyLabels = [];   // Label "Minggu x - 2025" untuk chart

    public function mount()
    {
        // Ambil data booking kamar berdasarkan minggu dan penginapan
        $weeklyData = DB::table('kamars')
            ->select(
                'penginapan_id',
                DB::raw("YEARWEEK(updated_at, 1) as year_week"),
                DB::raw("COUNT(*) as total")
            )
            ->where('status', 'telah dipesan')
            ->groupBy('penginapan_id', 'year_week')
            ->orderBy('year_week')
            ->get();

        // Koleksi data
        $weeklyData = collect($weeklyData);

        // Ambil semua penginapan dan simpan namanya
        $penginapans = Penginapan::all();
        $this->labels = $penginapans->pluck('nama')->toArray();

        // Ambil semua year_week unik
        $yearWeeks = $weeklyData->pluck('year_week')->unique()->sort()->values();

        // Simpan label minggu dalam bentuk "Minggu XX - YYYY"
        $this->weeklyLabels = $yearWeeks->map(function ($yearWeek) {
            $year = substr($yearWeek, 0, 4);
            $week = substr($yearWeek, 4);
            return "Minggu $week - $year";
        })->toArray();

        // Format ulang label agar bisa dicocokkan
        $formattedYearWeeks = $yearWeeks->map(function ($yearWeek) {
            return (string) $yearWeek;
        })->toArray();

        // Susun data per penginapan dan minggu
        $this->data = $penginapans->map(function ($penginapan) use ($weeklyData, $formattedYearWeeks) {
            return collect($formattedYearWeeks)->map(function ($yearWeek) use ($weeklyData, $penginapan) {
                $entry = $weeklyData->first(function ($item) use ($penginapan, $yearWeek) {
                    return $item->penginapan_id === $penginapan->id && $item->year_week == $yearWeek;
                });
                return $entry ? $entry->total : 0;
            })->toArray();
        })->toArray();
    }

    public function render()
    {
        return view('livewire.dashboard.penghuni-chart');
    }
}
