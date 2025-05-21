<?php

namespace App\Livewire\Masterorder;

use Livewire\Component;
use App\Models\Order;

class Edit extends Component
{
    public $orderId;
    public $order;

    public $status;
    public $jatuh_tempo;

    public function mount($orderId)
    {
        $this->order = Order::find($orderId);

        if (!$this->order) {
            session()->flash('error', 'Order tidak ditemukan!');
            return redirect()->route('masterorder.index');
        }

        $this->orderId = $orderId;
        $this->status = $this->order->status;
        $this->jatuh_tempo = optional($this->order->jatuh_tempo)->format('Y-m-d\TH:i');
    }

    public function update()
    {
        $this->validate([
            'status' => 'required|string',
            'jatuh_tempo' => 'nullable|date',
        ]);

        $this->order->status = $this->status;
        $this->order->jatuh_tempo = $this->jatuh_tempo;
        $this->order->save();

        session()->flash('message', 'Status dan jatuh tempo berhasil diperbarui!');
        return redirect()->route('masterorder');
    }

    public function render()
    {
        return view('livewire.masterorder.edit');
    }
}
