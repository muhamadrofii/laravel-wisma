<?php

namespace App\Livewire\User;
use App\Models\Penginapan;
use App\Models\Kamar;
use Livewire\Component;
use Carbon\Carbon;




class DetailRoom extends Component
{
    public $tanggal_mulai;
    public $tanggal_selesai;
    public $jumlahHari = 0;
    public $kamars;
    
// public $wismaTerpilih;

    public $wismaTerpilih;
    public $room;

    public function mount($id)
    {
        $this->room = Kamar::with('penginapan')->findOrFail($id);
    
        // Hitung harga per malam
        $baseHarga = match (strtolower($this->room->tipe_kelas)) {
            'standar' => 250000,
            'vip'     => 500000,
            'vvip'    => 750000,
            default   => 200000,
        };
    
        $tambah = 0;
        if ($this->room->ac) $tambah += 20000;
        if ($this->room->wifi) $tambah += 10000;
        if ($this->room->televisi) $tambah += 15000;
        if ($this->room->penjemputan) $tambah += 30000;
    
        $this->room->harga_per_malam = $baseHarga + $tambah;

        $room = Kamar::find($id);

        if ($this->room) {
            session([
                'selected_room' => [
                    'id' => $this->room->id,
                    'nomor_kamar' => $this->room->nomor_kamar,
                    'public_id' => $this->room->public_id,
                    'tipe_kelas' => $this->room->tipe_kelas,
                    'harga_per_malam' => $this->room->harga_per_malam, // ✅ SUDAH DIHITUNG
                    'gambar_url' => $this->room->gambar_url
                ]
            ]);
        }
        
    }
    
    

    // public function updatedTanggalMulai()
    // {
    //     $this->hitungJumlahHari();
    // }

    // public function updatedTanggalSelesai()
    // {
    //     $this->hitungJumlahHari();
    // }

    // public function hitungJumlahHari()
    // {
    //     if ($this->tanggal_mulai && $this->tanggal_selesai) {
    //         $start = Carbon::parse($this->tanggal_mulai);
    //         $end = Carbon::parse($this->tanggal_selesai);

    //         if ($end->greaterThan($start)) {
    //             $this->jumlahHari = $start->diffInDays($end);
    //         } else {
    //             $this->jumlahHari = 0;
    //         }
    //     }
    // }
    
    public function render()
    {
        return view('livewire.user.detail-room', [
            'kamars' => $this->kamars,
            'room' => $this->room,
        ])->layout('userlayouts.layout');
    }
}
    


