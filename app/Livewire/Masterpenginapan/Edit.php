<?php

namespace App\Livewire\Masterpenginapan;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Penginapan;
use App\Services\ImageKitService;

class Edit extends Component
{
    use WithFileUploads;

    public $imageId;
    public $nama;
    public $alamat;
    public $gambar;
    public $oldPublicId;

    public function mount($id)
    {
        $penginapan = Penginapan::findOrFail($id);
        $this->imageId = $penginapan->id;
        $this->nama = $penginapan->nama;
        $this->alamat = $penginapan->alamat;
        $this->oldPublicId = $penginapan->public_id;
    }

    public function update()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $penginapan = Penginapan::findOrFail($this->imageId);
        $penginapan->nama = $this->nama;
        $penginapan->alamat = $this->alamat;

        if ($this->gambar) {
            // Hapus gambar lama dari ImageKit jika ada
            if ($penginapan->public_id) {
                app(ImageKitService::class)->delete($penginapan->public_id);
            }

            // Upload gambar baru ke ImageKit (folder 'wisma')
            $file = $this->gambar;
            $fileName = $this->nama . '.' . $file->getClientOriginalExtension();

            $upload = app(ImageKitService::class)->upload(
                $file->getRealPath(),
                $fileName,
                'wisma'
            );

            if (isset($upload->result->fileId)) {
                $penginapan->gambar_url = $upload->result->url;
                $penginapan->public_id = $upload->result->fileId;
            } else {
                session()->flash('error', 'Upload gambar ke ImageKit gagal.');
                return;
            }
        }

        $penginapan->save();

        session()->flash('success', 'Data penginapan berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.masterpenginapan.edit');
    }
}
