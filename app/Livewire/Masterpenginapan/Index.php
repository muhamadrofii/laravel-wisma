<?php

namespace App\Livewire\Masterpenginapan;

use Livewire\Component;
use App\Models\Penginapan;
use App\Services\ImageKitService;

class Index extends Component
{
    // public function delete($id)
    // {
    //     $penginapan = Penginapan::findOrFail($id);
    
    //     if (!$penginapan->public_id) {
    //         session()->flash('error', 'File ID tidak ditemukan.');
    //         return;
    //     }
    
    //     // Logging opsional
    //     logger()->info("Deleting ImageKit file ID: " . $penginapan->public_id);
    
    //     $response = app(ImageKitService::class)->delete($penginapan->public_id);
    
    //     // Bisa tambahkan log responsenya jika perlu
    //     logger()->info('ImageKit Delete Response:', (array) $response);
    
    //     // Hapus dari database
    //     $penginapan->delete();
    
    //     session()->flash('success', 'Gambar berhasil dihapus.');
    // }

        public $showDeleteModal = false;
    public $deleteId = null;

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function deleteConfirmed()
    {
        $penginapan = Penginapan::findOrFail($this->deleteId);

        if (!$penginapan->public_id) {
            session()->flash('error', 'File ID tidak ditemukan.');
            return;
        }

        logger()->info("Deleting ImageKit file ID: " . $penginapan->public_id);
        $response = app(ImageKitService::class)->delete($penginapan->public_id);
        logger()->info('ImageKit Delete Response:', (array) $response);

        $penginapan->delete();

        $this->showDeleteModal = false;
        $this->deleteId = null;

        session()->flash('success', 'Gambar berhasil dihapus.');
    }
    
    



    public function render()
    {
        return view('livewire.masterpenginapan.index', ['penginapans' => Penginapan::latest()->get()]);
    }
}
