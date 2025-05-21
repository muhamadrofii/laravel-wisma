<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\DiklatParticipant;

class Diklat extends Component
{
    public $peserta = [];

    public function mount()
    {
        $this->peserta = DiklatParticipant::all();
    }

    public function render()
    {
        return view('livewire.users.diklat-view');
    }
}
