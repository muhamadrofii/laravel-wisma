<section id="why-us" class="why-us section dark-background">
<div class="container mt-5" style="margin-top: 5rem !important; margin-bottom: 4rem;">
<a href="{{ route('livewire.user.list-room') }}" 
   class="d-inline-block my-4 text-white" 
   style="font-size: 1.5rem;">
    <i class="bi bi-arrow-90deg-left"></i>
</a>


    @if ($room)
    {{-- <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100"> --}}
    <div class="row gy-5 align-items-start">
        <!-- Gambar kamar -->
        <div class="col-lg-8">
            <div class="portfolio-details-slider swiper init-swiper shadow rounded overflow-hidden">
                <script type="application/json" class="swiper-config">
                    {
                        "loop": true,
                        "speed": 600,
                        "autoplay": { "delay": 5000 },
                        "slidesPerView": "auto",
                        "pagination": {
                            "el": ".swiper-pagination",
                            "type": "bullets",
                            "clickable": true
                        }
                    }
                </script>
                <div class="swiper-wrapper align-items-center">
                    <div class="swiper-slide">
                        <img src="{{ $room->gambar_url }}" alt="Foto Kamar {{ $room->nomor_kamar }}" class="img-fluid rounded">
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

        <!-- Informasi kamar -->
        <div class="col-lg-4">
            <div class="portfolio-info mb-4 p-4 bg-light rounded shadow-sm" data-aos="fade-up" data-aos-delay="200" style="background: linear-gradient(to right, #d2dcea, #ffffff); color: #000;">
                <h3 class="mb-3 text-primary">Kamar No. {{ $room->nomor_kamar }}</h3>
                <ul class="list-unstyled">
                    {{-- <li><strong>Public ID:</strong> {{ $room->public_id }}</li> --}}
                    <li><strong>Tipe Kelas:</strong> {{ ucfirst($room->tipe_kelas) }}</li>
                    <li><strong>AC  :</strong> {{ $room->ac ? 'Ya' : 'Tidak' }}</li>
                    <li><strong>WiFi:</strong> {{ $room->wifi ? 'Ya' : 'Tidak' }}</li>
                    <li><strong>Televisi:</strong> {{ $room->televisi ? 'Ya' : 'Tidak' }}</li>
                    <li><strong>Penjemputan:</strong> {{ $room->penjemputan ? 'Ya' : 'Tidak' }}</li>
                    <li><strong>Status:</strong> {{ ucfirst($room->status) }}</li>
                    <li><strong>Harga per Malam:</strong> <span class="text-success">Rp{{ number_format($room->harga_per_malam, 0, ',', '.') }}</span></li>
                </ul>
            </div>

            <div class="portfolio-description p-4 bg-white rounded shadow-sm" data-aos="fade-up" data-aos-delay="300">
                <h4 class="text-success">Tertarik memesan kamar ini?</h4>
                {{-- <a href="{{ route('form.order', ['id' => $room->id]) }}" class="btn btn-primary mt-3 w-100">Pesan Sekarang</a> --}}
            </div>

            {{-- <a href="{{ route('livewire.user.order') }}" class="btn btn-primary mt-3 w-100">Pesan Sekarang</a> --}}
            @if (strtolower($room->status) === 'tersedia')
                <a href="{{ route('livewire.user.order') }}" class="btn btn-primary mt-3 w-100">Pesan Sekarang</a>
            @else
                <button type="button" class="btn btn-secondary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#kamarSudahDipesanModal">
                    Pesan Sekarang
                </button>
            @endif

            <!-- Modal kamar sudah dipesan -->
            <div class="modal fade" id="kamarSudahDipesanModal" tabindex="-1" aria-labelledby="kamarSudahDipesanLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-danger">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="kamarSudahDipesanLabel">Kamar Tidak Tersedia</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    Maaf, kamar ini sudah dipesan atau sedang tidak tersedia. Silakan pilih kamar lain.
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button> --}}
                </div>
                </div>
            </div>
            </div>




        {{-- </div> --}}
    </div>
    </div>
    @else
    <div class="alert alert-warning text-center py-5 mt-5">
        <strong>Ups!</strong> Tidak ada kamar ditemukan untuk penginapan yang dipilih.
    </div>
    @endif
</div>
  </section>
