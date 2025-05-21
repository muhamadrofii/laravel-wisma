<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\Kamar;
use App\Models\Penginapan;

class ListRoom extends Component
{
    public $rooms = [];
    // public $rooms = [];
    public $wismaTerpilih;


    public function mount()
    {
        $wismaId = Session::get('wisma_terpilih');
        
        if ($wismaId) {
            $wisma = Penginapan::with('kamars')->findOrFail($wismaId);
            $this->wismaTerpilih = $wisma;
            $this->rooms = $wisma->kamars;
        }
        
    }

    public function render()
    {
        return view('livewire.user.list-room', [
            'rooms' => $this->rooms
        ])->layout('userlayouts.layout');
    }
}
