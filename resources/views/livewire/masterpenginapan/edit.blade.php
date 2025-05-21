<div class="container mt-4">
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form wire:submit.prevent="update" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Penginapan</label>
            <input type="text" id="nama" wire:model="nama" class="form-control">
            @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea id="alamat" wire:model="alamat" class="form-control" rows="3"></textarea>
            @error('alamat') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Baru (opsional)</label>
            <input type="file" wire:model="gambar" class="form-control" accept="image/*">
            @error('gambar') <span class="text-danger">{{ $message }}</span> @enderror

            @if ($gambar)
                <div class="mt-2">
                    <p><strong>Preview Gambar Baru:</strong></p>
                    <img src="{{ $gambar->temporaryUrl() }}" class="img-fluid rounded" width="200">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
