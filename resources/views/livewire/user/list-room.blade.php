<section id="why-us" class="why-us section dark-background">
<div class="container py-5" style="margin-top: 2rem;">
<a href="{{ route('user.home') }}" 
   class="d-inline-block my-4 text-white" 
   style="font-size: 1.5rem;">
    <i class="bi bi-arrow-90deg-left"></i>
</a>

    @forelse ($rooms as $room)
        <div class="card mb-4 shadow-sm border-0">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ $room->gambar_url ?? 'https://i.imgur.com/QpjAiHq.jpg' }}" 
                         class="img-fluid rounded-start" 
                         alt="Gambar Kamar">
                </div>

                <div class="col-md-5">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold">
                            {{ 'Nomor Kamar : ' . ($room->nomor_kamar ?? 'Nomor Kamar') }}
                        </h5>
                        @if ($wismaTerpilih)
                            <p class="mb-1 text-muted">
                                Wisma: <strong>{{ $wismaTerpilih->nama }}</strong>
                            </p>
                        @endif
                        <p class="mb-1">
                            <i class="bi bi-people"></i> Kapasitas: {{ $room->kapasitas ?? '2 Orang' }}
                        </p>
                        <p class="mb-2">
                            <i class="bi bi-door-open"></i> Tipe: {{ ucfirst($room->tipe_kelas) }}
                        </p>
                    </div>
                </div>

                <div class="col-md-3 d-flex flex-column justify-content-center align-items-center bg-light rounded-end">
                    <div class="text-center">
                        <p class="text-success fw-semibold mt-2">
                            {{ ucfirst($room->status) }}
                        </p>
                        <a href="{{ route('livewire.user.detail-room', ['id' => $room->id]) }}" 
                           class="btn btn-outline-primary btn-sm mt-2">
                            <i class="fas fa-info-circle"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Tidak ada kamar tersedia.</div>
    @endforelse
</div>
</section>
