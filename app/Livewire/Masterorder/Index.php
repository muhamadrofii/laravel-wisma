<?php

namespace App\Livewire\Masterorder;

use Livewire\Component;
use App\Models\Order;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $selectedOrderId;

    protected $listeners = ['orderUpdated' => '$refresh'];

    public function selectOrder($orderId)
    {
        $this->selectedOrderId = $orderId;
    }

    public function delete()
    {
        if ($this->selectedOrderId) {
            Order::where('id', $this->selectedOrderId)->delete();
            session()->flash('message', 'Order berhasil dihapus.');
            $this->dispatch('closeModal');
        }
    }

    public function render()
    {
        return view('livewire.masterorder.index', [
            'orders' => Order::latest()->paginate(10),
        ]);
    }
}
