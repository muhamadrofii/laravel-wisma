<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;

class ProfileForm extends Component
{
    public string $name = '';
    public string $email = '';
    public string $nik = '';
    public string $no_telp = '';
    public string $alamat = '';
    public string $sertifikasi = '';
    public string $nama_sertifikasi = '';

    public function mount(): void
    {
        $user = Auth::user();

        $this->name = $user->name ?? '';
        $this->email = $user->email ?? '';
        $this->nik = $user->nik ?? '';
        $this->no_telp = $user->no_telp ?? '';
        $this->alamat = $user->alamat ?? '';
        $this->sertifikasi = $user->sertifikasi ?? '';
        $this->nama_sertifikasi = $user->nama_sertifikasi ?? '';
    }

    public function update(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],
            'nik' => ['nullable', 'string', 'max:20'],
            'no_telp' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string', 'max:255'],
            'sertifikasi' => ['nullable', 'string', 'max:255'],
            'nama_sertifikasi' => ['nullable', 'string', 'max:255'],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated');
    }

    public function render()
    {
        return view('livewire.user.profile-form')->layout('userlayouts.layout');
    }
}
