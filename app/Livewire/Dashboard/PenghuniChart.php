<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Penginapan;
use Carbon\Carbon;

class Penghunichart extends Component
{
    public $labels = [];         // Nama-nama penginapan
    public $data = [];           // Data jumlah booking per penginapan per hari
    public $weeklyLabels = [];   // Label tanggal 7 hari terakhir

    public function mount()
    {
        $startDate = Carbon::now()->subDays(6)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        // Ambil data booking per tanggal
        $dailyData = DB::table('kamars')
            ->select(
                'penginapan_id',
                DB::raw("DATE(updated_at) as tanggal"),
                DB::raw("COUNT(*) as total")
            )
            ->where('status', 'telah dipesan')
            ->whereBetween('updated_at', [$startDate, $endDate])
            ->groupBy('penginapan_id', DB::raw("DATE(updated_at)"))
            ->orderBy('tanggal')
            ->get();

        $dailyData = collect($dailyData);

        // Ambil 3 penginapan
        $penginapans = Penginapan::take(3)->get();
        $this->labels = $penginapans->pluck('nama')->toArray();

        // Ambil 7 hari terakhir sebagai label X
        $this->weeklyLabels = collect(range(0, 6))->map(function ($i) {
            return Carbon::now()->subDays(6 - $i)->format('Y-m-d');
        })->toArray();

        // Susun data untuk masing-masing penginapan
        $this->data = $penginapans->map(function ($penginapan) use ($dailyData) {
            return collect($this->weeklyLabels)->map(function ($tanggal) use ($dailyData, $penginapan) {
                $found = $dailyData->first(fn($item) => $item->penginapan_id == $penginapan->id && $item->tanggal == $tanggal);
                return $found ? $found->total : 0;
            })->toArray();
        })->toArray();
    }

    public function render()
    {
        return view('livewire.dashboard.penghuni-chart');
    }
}
