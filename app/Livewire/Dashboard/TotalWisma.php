<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Penginapan;
use App\Models\Kamar;
use App\Models\Order;

class TotalWisma extends Component
{
    public $totalWisma;
    public $jumlahKamarKosong;
    public $jumlahPenghuni;

    public function mount()
    {
        $this->totalWisma = Penginapan::count();

        $this->jumlahKamarKosong = Kamar::where('status', 'tersedia')->count();

        $this->jumlahPenghuni = Order::where('status', 'completed')
            ->select('user_id')
            ->distinct()
            ->count();
    }

    public function render()
    {
        return view('livewire.dashboard.total-wisma');
    }
}
