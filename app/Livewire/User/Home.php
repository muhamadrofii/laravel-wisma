<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Penginapan;
use App\Models\Kamar;
use Illuminate\Support\Facades\Session;
// use Livewire\Component;

class Home extends Component
{
    public $wismaTerpilih;
    public $kamars;

    public function render()
    {
        $wismaId = session('wisma_terpilih');

        if ($wismaId) {
            $this->wismaTerpilih = Penginapan::find($wismaId);
            $this->kamars = Kamar::where('penginapan_id', $wismaId)->get();
        } else {
            $this->kamars = collect(); // fallback jika belum memilih wisma
        }

        return view('livewire.user.index', [
            'penginapans' => Penginapan::latest()->get()
        ])->layout('userlayouts.layout');
    }

    public function pilihWisma($wismaId)
    {
        $wisma = Penginapan::findOrFail($wismaId);
        Session::put('wisma_terpilih', $wisma->id);

        return redirect()->route('livewire.user.list-room');
    }
}




// public function render()
// {
    // return view('livewire.masterpenginapan.index', ['penginapans' => Penginapan::latest()->get()]);
// }
