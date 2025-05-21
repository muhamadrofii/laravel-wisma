<section id="why-us" class="why-us section dark-background" style="margin-top: 5rem !important;">

    <!-- Section Title -->
    <div class="container section-title mb-2" data-aos="fade-up"> <!-- dikurangi margin bawah -->
      <h2 style="color: white; ">INFO</h2>
      <p>informasi kamar wisma migas, dari berbagai fasilitas dan pilihan kamar mulai dari yang terjangkau, silahkan pilih untuk melanjutkan</p>
    </div><!-- End Section Title -->
  
<div class="container mt-0">
    <div class="row gy-4">

        @php
            $user = auth()->user();
            $profileIncomplete = empty($user->nik) || empty($user->alamat) || empty($user->no_telp);
        @endphp

        @if ($profileIncomplete)
            <div class="col-12 text-center py-5">
                <h4 class="mb-3">Profil Anda Belum Lengkap</h4>
                <p class="text-muted mb-4">
                    Silakan lengkapi data profil Anda terlebih dahulu untuk melihat daftar penginapan.
                </p>
                <a href="{{ route('livewire.user.profile-form') }}" class="btn btn-primary">
                    Isi Profil Sekarang
                </a>
            </div>
        @else
            @foreach ($penginapans as $penginapan)
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-item">
                        <img src="{{ $penginapan->gambar_url }}" alt="Gambar {{ $penginapan->nama }}" class="img-fluid mb-3 rounded">
                        <h4>
                            <a wire:click.prevent="pilihWisma({{ $penginapan->id }})" href="#" class="stretched-link">
                                {{ $penginapan->nama }}
                            </a>
                        </h4>
                        <h5>
                            {{ 'Alamat : ' . $penginapan->alamat }}
                        </h5>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
</div>


  
  
  </section>