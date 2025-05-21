<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Penginapan;

class Dashboard extends Component
{
    public $totalPenginapan;

    public function mount()
    {
        $this->totalPenginapan = Penginapan::count(); // SELECT COUNT(*) FROM penginapans
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
