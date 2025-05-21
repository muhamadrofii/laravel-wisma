<div class="container mt-5">
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="save">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Penginapan</label>
            <input type="text" id="nama" wire:model.defer="nama" class="form-control">
            @error('nama') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea id="alamat" wire:model.defer="alamat" rows="3" class="form-control"></textarea>
            @error('alamat') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">File Gambar</label>
            <input type="file" id="image" wire:model="image" class="form-control">
            @error('image') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div wire:loading wire:target="image" class="form-text mb-2">
            Mengunggah gambar...
        </div>

        @if ($image)
            <div class="mb-3">
                <label class="form-label">Preview:</label><br>
                <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail mt-2" width="200">
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
