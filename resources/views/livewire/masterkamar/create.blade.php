<div class="container mt-4">
    <h2>Tambah Kamar</h2>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <form wire:submit.prevent="submit">
        <div class="mb-3">
            <label>Nomor Kamar</label>
            <input type="text" wire:model="nomor_kamar" class="form-control">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">File Gambar</label>
            <input type="file" id="image" wire:model="image" class="form-control">
            @error('image') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        {{-- <div class="mb-3">
            <label>Gambar URL</label>
            <input type="text" wire:model="gambar_url" class="form-control">
        </div>
        <div class="mb-3">
            <label>Public ID</label>
            <input type="text" wire:model="public_id" class="form-control">
        </div> --}}
        <div class="row">
            <div class="col-md-3">
                <label>AC</label>
                <select wire:model="ac" class="form-control">
                    <option value="">Pilih</option>
                    <option value="tersedia">Tersedia</option>
                    <option value="tidak tersedia">Tidak Tersedia</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>WiFi</label>
                <select wire:model="wifi" class="form-control">
                    <option value="">Pilih</option>
                    <option value="tersedia">Tersedia</option>
                    <option value="tidak tersedia">Tidak Tersedia</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>Televisi</label>
                <select wire:model="televisi" class="form-control">
                    <option value="">Pilih</option>
                    <option value="tersedia">Tersedia</option>
                    <option value="tidak tersedia">Tidak Tersedia</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>Penjemputan</label>
                <select wire:model="penjemputan" class="form-control">
                    <option value="">Pilih</option>
                    <option value="tersedia">Tersedia</option>
                    <option value="tidak tersedia">Tidak Tersedia</option>
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <label>Tipe Kelas</label>
                <select wire:model="tipe_kelas" class="form-control">
                    <option value="">Pilih</option>
                    <option value="reguler">Reguler</option>
                    <option value="VIP">VIP</option>
                    <option value="VVIP">VVIP</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Status</label>
                <select wire:model="status" class="form-control">
                    <option value="tersedia">Tersedia</option>
                    <option value="telah dipesan">Telah Dipesan</option>
                </select>
            </div>
        </div>
        <div class="mb-3 mt-3">
            <label>Nama Wisma</label>
            <select wire:model="penginapan_id" class="form-control">
                <option value="">-- Pilih Penginapan --</option>
                @foreach ($penginapans as $penginapan)
                    <option value="{{ $penginapan->id }}">{{ $penginapan->nama }}</option>
                @endforeach
            </select>
            @error('penginapan_id') <div class="text-danger">{{ $message }}</div> @enderror
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
        <button class="btn btn-success">Simpan</button>
    </form>
</div>
