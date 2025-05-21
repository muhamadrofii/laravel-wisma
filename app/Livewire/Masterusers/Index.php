<?php

namespace App\Livewire\Masterusers;
// namespace App\Livewire\Masterusers;
use App\Models\DiklatParticipant;
use App\Models\User;  
// use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

use Livewire\Component;

class Index extends Component
{
    use WithPagination;
    public $deleteId = null;
    public function render()
    {
        return view('livewire.masterusers.index', [
            'users' => User::latest()->paginate(5), // Ambil data users dengan urutan terbaru
        ]);

        
    }
    public function confirmDelete($id)
    {
        $this->deleteId = $id; // Simpan ID sementara
        $this->dispatch('show-delete-modal'); // Dispatch event untuk tampilkan modal
    }

    public function deleteUser()
    {
        if ($this->deleteId) {
            $user = User::find($this->deleteId);
            if ($user) {
                $user->delete();
                session()->flash('message', 'User berhasil dihapus.');
            }
            $this->deleteId = null; // Reset id
        }
    }

        public function exportBulanIni()
    {
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        $users = User::whereYear('created_at', $tahunIni)
                     ->whereMonth('created_at', $bulanIni)
                     ->get();

        return Excel::download(new UsersExport($users), 'users-bulan-ini.xlsx');
    }
}
