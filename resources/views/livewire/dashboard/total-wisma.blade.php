<div class="row">
    {{-- Total Wisma --}}
    <div class="col-lg-4">
        <div class="overflow-hidden rounded border" style="aspect-ratio: 16/6;">
            <div class="stats-item text-center">
                <i class="bi bi-buildings-fill" style="font-size: 2rem;"></i>
                <p class="card-text display-6">Total Wisma : {{ $totalWisma }}</p>
            </div>
        </div>
    </div>

    {{-- Kamar Kosong --}}
    <div class="col-lg-4">
        <div class="overflow-hidden rounded border" style="aspect-ratio: 16/6;">
            <div class="stats-item text-center">
                <i class="bi bi-door-open-fill" style="font-size: 2rem;"></i>
                <p class="card-text display-6">Kamar Kosong : {{ $jumlahKamarKosong }}</p>
            </div>
        </div>
    </div>

    {{-- Penghuni Wisma --}}
    <div class="col-lg-4">
        <div class="overflow-hidden rounded border" style="aspect-ratio: 16/6;">
            <div class="stats-item text-center">
                <i class="bi bi-people-fill" style="font-size: 2rem;"></i>
                <p class="card-text display-6">Penghuni Wisma : {{ $jumlahPenghuni }}</p>
            </div>
        </div>
    </div>
</div>
