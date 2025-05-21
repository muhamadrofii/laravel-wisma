<?php

namespace App\Livewire\Masterkamar;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Kamar;
use App\Models\Penginapan;
use App\Services\ImageKitServiceSecond;

class Edit extends Component
{
    use WithFileUploads;

    public $penginapans;
    public $kamarId;
    public $nomor_kamar, $gambar_url, $public_id, $ac, $wifi, $televisi, $penjemputan, $status, $tipe_kelas, $penginapan_id;
    public $image; // gambar baru

    public function mount($id)
    {
        $this->penginapans = Penginapan::all();
        $kamar = Kamar::findOrFail($id);

        $this->kamarId = $kamar->id;
        $this->nomor_kamar = $kamar->nomor_kamar;
        $this->gambar_url = $kamar->gambar_url;
        $this->public_id = $kamar->public_id;
        $this->ac = $kamar->ac;
        $this->wifi = $kamar->wifi;
        $this->televisi = $kamar->televisi;
        $this->penjemputan = $kamar->penjemputan;
        $this->status = $kamar->status;
        $this->tipe_kelas = $kamar->tipe_kelas;
        $this->penginapan_id = $kamar->penginapan_id;
    }

    public function update()
    {
        $this->validate([
            'nomor_kamar' => 'required|string|max:255',
            'ac' => 'required|in:tersedia,tidak tersedia',
            'wifi' => 'required|in:tersedia,tidak tersedia',
            'televisi' => 'required|in:tersedia,tidak tersedia',
            'penjemputan' => 'required|in:tersedia,tidak tersedia',
            'status' => 'required|in:tersedia,telah dipesan',
            'tipe_kelas' => 'required|in:reguler,VIP,VVIP',
            'penginapan_id' => 'required|exists:penginapans,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $kamar = Kamar::findOrFail($this->kamarId);

        // Jika user mengunggah gambar baru
        if ($this->image) {
            // Hapus gambar lama dari ImageKit
            if ($kamar->public_id) {
                app(ImageKitServiceSecond::class)->delete($kamar->public_id);
            }

            // Upload gambar baru
            $file = $this->image;
            $upload = app(ImageKitServiceSecond::class)->upload(
                $file->getRealPath(),
                $this->nomor_kamar . '.' . $file->getClientOriginalExtension(),
                'kamar'
            );

            if (isset($upload->result->fileId)) {
                $kamar->gambar_url = $upload->result->url;
                $kamar->public_id = $upload->result->fileId;
            } else {
                session()->flash('error', 'Gagal upload gambar.');
                return;
            }
        }

        $kamar->update([
            'nomor_kamar' => $this->nomor_kamar,
            'ac' => $this->ac,
            'wifi' => $this->wifi,
            'televisi' => $this->televisi,
            'penjemputan' => $this->penjemputan,
            'status' => $this->status,
            'tipe_kelas' => $this->tipe_kelas,
            'penginapan_id' => $this->penginapan_id,
        ]);

        session()->flash('message', 'Kamar berhasil diperbarui.');
        return redirect()->to('/masterkamar');
    }

    public function render()
    {
        return view('livewire.masterkamar.edit');
    }
}
