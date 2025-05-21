<div class="container mt-4">
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @elseif (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form wire:submit.prevent="update" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Nomor Kamar</label>
            <input type="text" class="form-control" wire:model="nomor_kamar">
            @error('nomor_kamar') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Penginapan</label>
            <select wire:model="penginapan_id" class="form-control">
                <option value="">Pilih Penginapan</option>
                @foreach($penginapans as $p)
                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                @endforeach
            </select>
            @error('penginapan_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Tampilkan gambar saat ini -->
        <div class="mb-3">
            <label>Gambar Sekarang:</label><br>
            <img src="{{ $gambar_url }}" width="200" class="img-fluid rounded">
        </div>

        <!-- Gambar baru (optional) -->
        <div class="mb-3">
            <label>Upload Gambar Baru</label>
            <input type="file" wire:model="image" class="form-control">
            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Fasilitas -->
        @foreach (['ac', 'wifi', 'televisi', 'penjemputan'] as $fasilitas)
            <div class="mb-3">
                <label>{{ ucfirst($fasilitas) }}</label>
                <select wire:model="{{ $fasilitas }}" class="form-control">
                    <option value="tersedia">Tersedia</option>
                    <option value="tidak tersedia">Tidak Tersedia</option>
                </select>
            </div>
        @endforeach

        <div class="mb-3">
            <label>Status</label>
            <select wire:model="status" class="form-control">
                <option value="tersedia">Tersedia</option>
                <option value="telah dipesan">Telah Dipesan</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Tipe Kelas</label>
            <select wire:model="tipe_kelas" class="form-control">
                <option value="reguler">Reguler</option>
                <option value="VIP">VIP</option>
                <option value="VVIP">VVIP</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Kamar</button>
    </form>
</div>
