<div>
    <form wire:submit.prevent="store">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" wire:model="name" class="form-control">
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" wire:model="email" class="form-control">
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" wire:model="password" class="form-control">
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Konfirmasi Password</label>
            <input type="password" wire:model="password_confirmation" class="form-control">
        </div>

        <div class="mb-3">
            <label>NIK</label>
            <input type="text" wire:model="nik" class="form-control">
            @error('nik') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>No Telp</label>
            <input type="text" wire:model="no_telp" class="form-control">
            @error('no_telp') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea wire:model="alamat" class="form-control"></textarea>
            @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select wire:model="role" class="form-control">
                <option value="">-- Pilih Role --</option>
                <option value="admin">Admin</option>
                <option value="peserta">Peserta</option>
                <option value="umum">Umum</option>
            </select>
            @error('role') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Sertifikasi</label>
            <select wire:model="sertifikasi" class="form-control">
                <option value="">-- Pilih --</option>
                <option value="ya">Ya</option>
                <option value="tidak">Tidak</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Nama Sertifikasi</label>
            <input type="text" wire:model="nama_sertifikasi" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
