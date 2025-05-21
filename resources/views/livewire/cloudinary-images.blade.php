<div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="upload" enctype="multipart/form-data">
        <input type="file" wire:model="file">
        @error('file') <span class="text-danger">{{ $message }}</span> @enderror
        <button type="submit">Upload</button>
    </form>

    <hr>

    <h2>Uploaded Images</h2>

    <div style="display: flex; flex-wrap: wrap; gap: 1rem;">
        @foreach($images as $image)
            <div style="border: 1px solid #ccc; padding: 10px;">
                <img src="{{ $image->image_url }}" alt="Image" width="150">

                @if ($editingImageId === $image->id)
                    <form wire:submit.prevent="update" enctype="multipart/form-data">
                        <input type="file" wire:model="newFile">
                        @error('newFile') <span class="text-danger">{{ $message }}</span> @enderror
                        <button type="submit">Save</button>
                        <button type="button" wire:click="$set('editingImageId', null)">Cancel</button>
                    </form>
                @else
                    <div style="margin-top: 10px;">
                        <button wire:click="edit({{ $image->id }})">Edit</button>
                        <button wire:click="delete({{ $image->id }})" onclick="return confirm('Are you sure?')">Delete</button>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
