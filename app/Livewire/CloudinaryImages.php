<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Image;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CloudinaryImages extends Component
{
    use WithFileUploads;

    public $file;
    public $images;
    public $editingImageId;
    public $newFile;

    public function mount()
    {
        $this->images = Image::latest()->get();
    }

    public function render()
    {
        return view('livewire.cloudinary-images');
    }

    public function upload()
    {
        $this->validate([
            'file' => 'required|image|max:10240', // max 10MB
        ]);

        $uploadResult = Cloudinary::upload($this->file->getRealPath(), [
            'folder' => 'wisma',
        ]);

        Image::create([
            'image_url' => $uploadResult->getSecurePath(),
            'public_id' => $uploadResult->getPublicId(),
        ]);

        $this->reset('file');
        $this->refreshImages();
        session()->flash('message', 'Image uploaded successfully.');
    }

    public function delete($id)
    {
        $image = Image::findOrFail($id);
        Cloudinary::destroy($image->public_id);
        $image->delete();

        $this->refreshImages();
        session()->flash('message', 'Image deleted successfully.');
    }

    public function edit($id)
    {
        $this->editingImageId = $id;
    }

    public function update()
    {
        $this->validate([
            'newFile' => 'required|image|max:10240',
        ]);

        $image = Image::findOrFail($this->editingImageId);
        Cloudinary::destroy($image->public_id);

        $uploadResult = Cloudinary::upload($this->newFile->getRealPath(), [
            'folder' => 'wisma',
        ]);

        $image->update([
            'image_url' => $uploadResult->getSecurePath(),
            'public_id' => $uploadResult->getPublicId(),
        ]);

        $this->reset(['editingImageId', 'newFile']);
        $this->refreshImages();
        session()->flash('message', 'Image updated successfully.');
    }

    public function refreshImages()
    {
        $this->images = Image::latest()->get();
    }
}
