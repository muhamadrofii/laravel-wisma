<div class="container mt-4">
    <a href="{{ route('masterpenginapan.create') }}" class="btn btn-success mb-3">Upload</a>

    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        @foreach($penginapans as $penginapan)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $penginapan->gambar_url }}" class="card-img-top" alt="{{ $penginapan->nama }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $penginapan->nama }}</h5>
                        <a href="{{ route('masterpenginapan.edit', $penginapan->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <button wire:click="confirmDelete({{ $penginapan->id }})" class="btn btn-danger btn-sm">Delete</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Modal Konfirmasi --}}
    @if($showDeleteModal)
        <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5)">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close" wire:click="$set('showDeleteModal', false)"></button>
                    </div>
                    <div class="modal-body">
                        <p>Yakin ingin menghapus gambar ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" wire:click="$set('showDeleteModal', false)">Batal</button>
                        <button class="btn btn-danger" wire:click="deleteConfirmed">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
