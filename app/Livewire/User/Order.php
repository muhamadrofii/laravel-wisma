<?php

namespace App\Livewire\User;
// namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Order as Ordered;
use Xendit\Configuration;
use Xendit\Invoice\CreateInvoiceRequest;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\InvoiceItem;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class Order extends Component
{
    public $invoiceUrl;
    public $room;
    public $user_id;

    public $name;
    public $email;
    public $no_telp;
    public $tanggal_mulai;
    public $tanggal_selesai;
    public $jumlahHari = 0;

    public function updatedTanggalMulai()
    {
        $this->hitungJumlahHari();
    }

    public function updatedTanggalSelesai()
    {
        $this->hitungJumlahHari();
    }

    public function hitungJumlahHari()
    {
        if ($this->tanggal_mulai && $this->tanggal_selesai) {
            $start = Carbon::parse($this->tanggal_mulai);
            $end = Carbon::parse($this->tanggal_selesai);

            if ($end->greaterThan($start)) {
                $this->jumlahHari = $start->diffInDays($end);
            } else {
                $this->jumlahHari = 0;
            }
        }
    }

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->no_telp = auth()->user()->no_telp;
        $this->user_id = auth()->user()->id;
        $this->room = session('selected_room');
        if (!$this->room) {
            session()->flash('error', 'Tidak ada kamar yang dipilih.');
        }
    }

    public function createInvoice()
    {
        try {
            if (!$this->room) {
                session()->flash('error', 'Tidak ada kamar yang dipilih.');
                return;
            }
    
            if ($this->jumlahHari <= 0) {
                session()->flash('error', 'Tanggal tidak valid. Silakan pilih tanggal mulai dan selesai dengan benar.');
                return;
            }

            if (!$this->tanggal_mulai || !$this->tanggal_selesai) {
                session()->flash('error', 'Tanggal check-in dan check-out harus diisi.');
                return;
            }

    
            $pricePerNight = $this->room['harga_per_malam'];
            $qty = $this->jumlahHari;
            $totalPrice = $pricePerNight * $qty;
            // $totalPriceForXendit = $totalPrice * 10;
            $no_transaction = 'INV-' . strtoupper(uniqid());
    
            $items = new InvoiceItem([
                'name' => 'Kamar No. ' . $this->room['nomor_kamar'],
                'price' => $pricePerNight,
                'quantity' => $qty,
            ]);
    
            Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));
    
            $createInvoice = new CreateInvoiceRequest([
                'external_id' => $no_transaction,
                'amount' => $totalPrice,
                'invoice_duration' => 172800, // 2 hari
                'items' => [$items],
            ]);
    
            $apiInstance = new InvoiceApi();
            $generateInvoice = $apiInstance->createInvoice($createInvoice);
    
            Ordered::create([
                'no_transaction' => $no_transaction,
                'external_id' => $no_transaction,
                'item_name' => 'Kamar No. ' . $this->room['nomor_kamar'],
                'qty' => $qty,
                'price' => $totalPrice,
                'invoice_url' => $generateInvoice['invoice_url'],
                'status' => 'Pending',
                'jumlah_hari' => $this->jumlahHari,
                
                'checkin' => $this->tanggal_mulai,   // ✅ simpan tanggal mulai
                'checkout' => $this->tanggal_selesai,
                
                // Simpan informasi user
                'user_id' => $this->user_id,
                'kamar_id' => $this->room['id'],
                'name' => $this->name,
                'email' => $this->email,
                'no_telp' => $this->no_telp,

            ]);
    
            $this->invoiceUrl = $generateInvoice['invoice_url'];
            $this->dispatch('invoice-created', $this->invoiceUrl);
    
        } catch (\Throwable $th) {
            logger()->error('Xendit Invoice Error: ' . $th->getMessage());
            session()->flash('error', 'Gagal membuat invoice.' . $th->getMessage());
        }
    }
    

    public function render()
    {
        return view('livewire.user.order')
            ->layout('userlayouts.layout');
    }
}

