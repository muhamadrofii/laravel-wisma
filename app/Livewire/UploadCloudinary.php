<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;

class UploadCloudinary extends Component
{
    use WithFileUploads;

    public $photo;

    public function upload()
    {
        $this->validate([
            'photo' => 'required|image|max:10240', // maksimal 10MB
        ]);

        try {
            // Upload ke Cloudinary
            Cloudinary::upload($this->photo->getRealPath());

            // Kalau sukses
            session()->flash('message', 'Upload berhasil!');
        } catch (Exception $e) {
            // Kalau gagal
            session()->flash('error', 'Upload gagal: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.upload-cloudinary');
    }
}
