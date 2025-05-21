<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Milon\Barcode\Facades\DNS2DFacade as DNS2D;   // ✅ pakai QR-code

class HistoryUser extends Component
{
    public $orders = [];
    public $selectedInvoiceUrl;
    public $selectedOrder;          // dipakai di modal barcode

    public function mount()
    {
        $this->orders = Order::with('kamar')
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();
    }

        /** -------- INVOICE (tidak berubah) -------- */
    public function showBarcode($orderId)
    {
        $this->selectedOrder = Order::find($orderId);
        $this->dispatch('show-barcode-modal'); // ✅ Livewire v3
    }

    public function showInvoice($url)
    {
        $this->selectedInvoiceUrl = $url;
        $this->dispatch('show-invoice-modal'); // ✅ Livewire v3
    }


    public function render()
    {
        return view('livewire.user.history-user')
            ->layout('userlayouts.layout');
    }
}
