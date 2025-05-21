<?php

namespace App\Livewire\Masterpenginapan;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Penginapan;
use App\Services\ImageKitService;

class Create extends Component
{
    use WithFileUploads;

    public $image;
    public $nama;
    public $alamat;

    
    public function save()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'image' => 'required|image|max:2048',
        ]);
    
        $file = $this->image;
        $upload = app(ImageKitService::class)->upload(
            $file->getRealPath(),
            $this->nama . '.' . $file->getClientOriginalExtension(), 'wisma'
        );
        
    
        if (isset($upload->result->fileId)) {

            $filename = $this->nama . '.' . $file->getClientOriginalExtension();

            // Tambahkan /wisma/ ke dalam URL-nya secara manual
            $url = rtrim(config('services.imagekit.url_endpoint'), '/') . '/wisma/wisma/' . $filename;
            Penginapan::create([
                'nama' => $this->nama,
                'alamat' => $this->alamat,
                'gambar_url' => $upload->result->url,
                'public_id' => $upload->result->fileId,
            ]);
    
            session()->flash('success', 'Uploaded!');
            $this->reset(['nama', 'image']);
        } else {
            session()->flash('error', 'Upload gagal.');
        }
    }
    

    public function render()
    {
        return view('livewire.masterpenginapan.create');
    }
}
