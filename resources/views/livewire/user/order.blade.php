<div class="container" style="margin-top: 12rem; margin-bottom: 8rem;">
    {{-- Flash Messages --}}
    @if (session()->has('error'))
        <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    @if ($room)
        <div class="card mb-5 shadow-lg border-0">
            <div class="card-body">
                <h5 class="card-title text-primary fw-bold">Kamar No. {{ $room['nomor_kamar'] }}</h5>
                <ul class="list-unstyled mb-3">
                    <li><strong>Public ID:</strong> {{ $room['public_id'] }}</li>
                    <li><strong>Tipe Kelas:</strong> {{ ucfirst($room['tipe_kelas']) }}</li>
                    <li><strong>Harga per Malam:</strong> 
                        <span class="text-success fw-semibold">Rp{{ number_format($room['harga_per_malam'], 0, ',', '.') }}</span>
                    </li>
                </ul>
                <img src="{{ $room['gambar_url'] }}" alt="Foto Kamar" class="img-fluid rounded border shadow-sm mt-3">
            </div>
        </div>

        <div class="row">
            {{-- Form Tanggal --}}
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-control" wire:model.lazy="tanggal_mulai">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date" class="form-control" wire:model.lazy="tanggal_selesai">
                </div>

                @if($jumlahHari > 0)
                    <div class="alert alert-success my-3">
                        Total lama menginap: <strong>{{ $jumlahHari }} hari</strong>
                    </div>
                @elseif($tanggal_mulai && $tanggal_selesai)
                    <div class="alert alert-warning my-3">
                        Tanggal selesai harus setelah tanggal mulai.
                    </div>
                @endif
            </div>

            {{-- Info Pengguna --}}
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" value="{{ $name }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" value="{{ $email }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">No HP</label>
                    <input type="text" class="form-control" value="{{ $no_telp }}" readonly>
                </div>
                {{-- <div class="mb-3">
                    <label class="form-label">User ID</label>
                    <input type="text" class="form-control" value="{{ $user_id }}" readonly>
                </div> --}}
            </div>
        </div>

        {{-- Form Pembayaran --}}
        <form wire:submit.prevent="createInvoice">
            <div class="card shadow-sm p-4 border-0 mt-4">
                <h5 class="mb-3 fw-semibold">Bayar Sekarang</h5>
                <button type="submit" class="btn btn-success w-100 py-2 fw-bold">
                    Bayar
                </button>
            </div>
        </form>
    @else
        <div class="alert alert-warning text-center shadow-sm">Tidak ada kamar yang dipilih.</div>
    @endif

    {{-- Modal Bootstrap --}}
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title">Lanjutkan Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body p-0">
                    @if ($invoiceUrl)
                        <iframe src="{{ $invoiceUrl }}" width="100%" height="600" frameborder="0"></iframe>
                    @else
                        <div class="p-3 text-center">Tidak ada URL pembayaran tersedia.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Script --}}
    @push('scripts')
    <script>
        Livewire.on('invoice-created', () => {
            const modal = new bootstrap.Modal(document.getElementById('paymentModal'));
            modal.show();
        });
    </script>
    @endpush
</div>
