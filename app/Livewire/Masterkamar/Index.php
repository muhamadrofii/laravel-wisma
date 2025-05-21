<?php

namespace App\Livewire\Masterkamar;

use App\Models\Kamar;
use App\Models\Penginapan;
use Livewire\Component;
use App\Services\ImageKitService;

class Index extends Component
{
    public $kamars;
    public $totalPenginapan;
    public $confirmingDeleteId = null;

    public function mount()
    {
        $this->kamars = Kamar::all();
        $this->totalPenginapan = Penginapan::count();
    }

    public function confirmDelete($id)
    {
        $this->confirmingDeleteId = $id;
    }

    public function deleteConfirmed()
    {
        $kamar = Kamar::findOrFail($this->confirmingDeleteId);

        if (!$kamar->public_id) {
            session()->flash('error', 'File ID tidak ditemukan.');
            return;
        }

        logger()->info("Deleting ImageKit file ID: " . $kamar->public_id);

        $response = app(ImageKitService::class)->delete($kamar->public_id);

        logger()->info('ImageKit Delete Response:', (array) $response);

        $kamar->delete();

        session()->flash('message', 'Kamar berhasil dihapus.');

        // Refresh data
        $this->kamars = Kamar::all();
        $this->confirmingDeleteId = null;
    }

    public function render()
    {
        return view('livewire.masterkamar.index');
    }
}
