<?php

namespace App\Livewire\Masterusers;
use App\Models\DiklatParticipant;
use Carbon\Carbon;
use App\Models\User;

// use Livewire\Component;
use Livewire\Attributes\Rule;

use Livewire\Component;

class Edit extends Component
{
    public $userID;

    #[Rule('required')] public $name;
    #[Rule('required|email')] public $email;
    #[Rule('nullable|string|max:16')] public $nik;
    #[Rule('nullable|string')] public $no_telp;
    #[Rule('nullable|string')] public $alamat;
    #[Rule('required|in:admin,peserta,umum')] public $role;
    #[Rule('nullable|in:ya,tidak')] public $sertifikasi;
    #[Rule('nullable|string')] public $nama_sertifikasi;

    public function mount($id)
    {
        $user = User::findOrFail($id);
        $this->userID           = $user->id;
        $this->name             = $user->name;
        $this->email            = $user->email;
        $this->nik              = $user->nik;
        $this->no_telp          = $user->no_telp;
        $this->alamat           = $user->alamat;
        $this->role             = $user->role;
        $this->sertifikasi      = $user->sertifikasi;
        $this->nama_sertifikasi = $user->nama_sertifikasi;
    }

    public function update()
    {
        $this->validate();

        $user = User::findOrFail($this->userID);

        $user->update([
            'name'             => $this->name,
            'email'            => $this->email,
            'nik'              => $this->nik,
            'no_telp'          => $this->no_telp,
            'alamat'           => $this->alamat,
            'role'             => $this->role,
            'sertifikasi'      => $this->sertifikasi,
            'nama_sertifikasi' => $this->nama_sertifikasi,
        ]);

        session()->flash('message', 'Data user berhasil diperbarui.');
        return redirect()->route('masterusers');
    }

    public function render()
    {
        return view('livewire.masterusers.edit');
    }
}
