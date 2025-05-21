@section('title', 'Edit Profil')

<section class="py-5" style="margin-top: 8rem;">
    <div class="container d-flex justify-content-center">
        <div class="row w-100" style="max-width: 800px;">
            <div class="col-md-12">
                <h3>Edit Profil</h3>

                <form wire:submit.prevent="update">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input wire:model.defer="name" type="text" id="name" class="form-control" required>
                        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input wire:model.defer="email" type="email" id="email" class="form-control" required>
                        @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input wire:model.defer="nik" type="text" id="nik" class="form-control">
                        @error('nik') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No. Telepon</label>
                        <input wire:model.defer="no_telp" type="text" id="no_telp" class="form-control">
                        @error('no_telp') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea wire:model.defer="alamat" id="alamat" class="form-control"></textarea>
                        @error('alamat') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="sertifikasi" class="form-label">Sertifikasi</label>
                        <input wire:model.defer="sertifikasi" type="text" id="sertifikasi" class="form-control">
                        @error('sertifikasi') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama_sertifikasi" class="form-label">Nama Sertifikasi</label>
                        <input wire:model.defer="nama_sertifikasi" type="text" id="nama_sertifikasi" class="form-control">
                        @error('nama_sertifikasi') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <x-action-message on="profile-updated">
                            <span class="text-success">Perubahan disimpan.</span>
                        </x-action-message>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="savedModal" tabindex="-1" aria-labelledby="savedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="savedModalLabel">Sukses</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    Profil berhasil diperbarui.
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    Livewire.on('profile-updated', () => {
        const modal = new bootstrap.Modal(document.getElementById('savedModal'));
        modal.show();
    });
</script>
@endpush
