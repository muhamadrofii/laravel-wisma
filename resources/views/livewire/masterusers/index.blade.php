{{-- @extends('layouts.app') --}}

@section('title')
Data Peserta Diklat - Belajar Livewire 3 di SantriKoding.com
@endsection

<div class="container-md mt-8 mb-8">
    <div class="row">
        <div class="col-lg-12 mx-auto">

            <!-- Flash Message -->
            @if (session()->has('message'))
            <div id="flash-message" class="alert alert-success">
                {{ session('message') }}
            </div>
        
            <script>
                // Hilangkan elemen setelah 3 detik (3000 ms)
                setTimeout(function () {
                    const flash = document.getElementById('flash-message');
                    if (flash) {
                        flash.style.transition = 'opacity 0.5s ease';
                        flash.style.opacity = '0';
                        setTimeout(() => flash.remove(), 500); // Hapus dari DOM setelah animasi selesai
                    }
                }, 3000);
            </script>
        @endif
            <!-- End Flash Message -->

            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('masterusers.create') }}" wire:navigate class="btn btn-md btn-success rounded shadow-sm border-0">
                    Tambah User
                </a>

                <button wire:click="exportBulanIni" class="btn btn-success">
                    Export User Bulan Ini
                </button>
            </div>




            <div class="card border-0 rounded shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-success text-white">
                                <tr>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">NIK</th>
                                    <th scope="col">Telp</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Sertifikasi</th>
                                    <th scope="col">Nama Sertifikasi</th>
                                    <th scope="col" style="width: 15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->alamat }}</td>
                                    <td>{{ $user->nik }}</td>
                                    <td>{{ $user->no_telp }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>{{ $user->sertifikasi }}</td>
                                    <td>{{ $user->nama_sertifikasi }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('masterusers.edit', $user->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                        <button 
                                                wire:click="confirmDelete('{{ $user->id }}')" 
                                                class="btn btn-sm btn-danger">
                                                DELETE
                                            </button>

                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center text-danger">
                                        Data Peserta Diklat belum tersedia.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                                                <!-- Modal Konfirmasi Delete -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" wire:ignore.self>
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus user ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="button" class="btn btn-danger" wire:click="deleteUser" data-bs-dismiss="modal">Hapus</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Pagination -->
                    {{ $users->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', function () {
        Livewire.on('show-delete-modal', () => {
            var myModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            myModal.show();
        });
    });
</script>
