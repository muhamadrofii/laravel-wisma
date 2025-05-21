<?php

namespace App\Livewire\Masterkamar;
// use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Kamar;

use App\Services\ImageKitServiceSecond;
use Livewire\Component;
use App\Models\Penginapan;


class Create extends Component
{
    public $penginapans;
    use WithFileUploads;
    public $nomor_kamar, $gambar_url, $public_id, $ac, $wifi, $televisi, $penjemputan, $status = 'tersedia', $tipe_kelas, $penginapan_id;


    public $image;

        // 'nama' => 'required|string|max:255',
        // 'alamat' => 'required|string|max:500',
        
        public function mount()
        {
            $this->penginapans = Penginapan::all();
        }

        public function submit()
        {
            $this->validate([
                'nomor_kamar' => 'required|string|max:255',
                'image' => 'required|image|max:2048',
                'ac' => 'required|in:tersedia,tidak tersedia',
                'wifi' => 'required|in:tersedia,tidak tersedia',
                'televisi' => 'required|in:tersedia,tidak tersedia',
                'penjemputan' => 'required|in:tersedia,tidak tersedia',
                'status' => 'required|in:tersedia,telah dipesan',
                'tipe_kelas' => 'required|in:reguler,VIP,VVIP',
                'penginapan_id' => 'required|exists:penginapans,id',
            ]);
        
            $file = $this->image;
            $upload = app(ImageKitServiceSecond::class)->upload(
                $file->getRealPath(),
                $this->nomor_kamar . '.' . $file->getClientOriginalExtension(),
                'kamar'
            );
        
            if (isset($upload->result->fileId)) {
                Kamar::create([
                    'nomor_kamar' => $this->nomor_kamar,
                    'gambar_url' => $upload->result->url,
                    'public_id' => $upload->result->fileId,
                    'ac' => $this->ac,
                    'wifi' => $this->wifi,
                    'televisi' => $this->televisi,
                    'penjemputan' => $this->penjemputan,
                    'status' => $this->status,
                    'tipe_kelas' => $this->tipe_kelas,
                    'penginapan_id' => $this->penginapan_id,
                ]);
        
                session()->flash('message', 'Kamar berhasil ditambahkan.');
                return redirect()->to('/masterkamar');
            }
        
            session()->flash('error', 'Gagal upload gambar.');
        }

        

    public function render()
    {
        return view('livewire.masterkamar.create');
    }
}
