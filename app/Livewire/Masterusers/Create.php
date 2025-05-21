<?php

namespace App\Livewire\Masterusers;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Livewire\Attributes\Rule;

class Create extends Component
{
    #[Rule('required', message: 'Masukkan Nama Lengkap')]
    public $name;

    #[Rule('required|email|unique:users,email', message: 'Email wajib diisi dan harus unik')]
    public $email;

    #[Rule('required', message: 'Masukkan Role')]
    public $role;

    #[Rule('required|min:6|confirmed', message: 'Password minimal 6 karakter dan harus dikonfirmasi')]
    public $password;

    public $password_confirmation;

    #[Rule('required', message: 'Masukkan NIK')]
    public $nik;

    #[Rule('required', message: 'Masukkan No Telepon')]
    public $no_telp;

    #[Rule('required', message: 'Masukkan Alamat')]
    public $alamat;

    #[Rule('nullable')]
    public $sertifikasi;

    #[Rule('nullable')]
    public $nama_sertifikasi;

    public function store()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'password' => Hash::make($this->password),
            'nik' => $this->nik,
            'no_telp' => $this->no_telp,
            'alamat' => $this->alamat,
            'sertifikasi' => $this->sertifikasi,
            'nama_sertifikasi' => $this->nama_sertifikasi,
        ]);

        session()->flash('message', 'User berhasil ditambahkan.');
        return redirect()->route('masterusers');
    }

    public function render()
    {
        return view('livewire.masterusers.create');
    }
}
