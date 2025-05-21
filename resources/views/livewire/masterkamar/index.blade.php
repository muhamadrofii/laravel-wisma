<div class="container mt-4">
    <h2>Daftar Kamar</h2>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <a href="{{ route('masterkamar.create') }}" class="btn btn-primary mb-3">Tambah Kamar</a>
    {{-- <h4>{{ $totalPenginapan }} Penginapan</h4> --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nomor</th>
                <th>Tipe</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kamars as $kamar)
                <tr>
                    <td>{{ $kamar->nomor_kamar }}</td>
                    <td>{{ $kamar->tipe_kelas }}</td>
                    <td>{{ $kamar->status }}</td>
                    <td>
                        <a href="{{ url('masterkamar/edit', $kamar->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <button
                            wire:click="confirmDelete({{ $kamar->id }})"
                            class="btn btn-sm btn-danger"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteModal">
                            Hapus
                        </button>

                        <!-- Modal Konfirmasi Hapus -->
<div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus kamar ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger" wire:click="deleteConfirmed" data-bs-dismiss="modal">Hapus</button>
      </div>
    </div>
  </div>
</div>


                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
