{{-- <div> --}}
    {{-- <pre>@json($peserta)</pre> --}}
{{-- </div> --}}

<div class="container py-4">
    <h1 class="mb-4">Peserta Diklat</h1>

    <!-- Tombol Tambah -->
    {{-- <a href="{{ route('peserta.create') }}" class="btn btn-primary mb-3"> --}}
        <i class='bx bx-plus'></i> Tambah Peserta
    </a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Diklat</th>
                <th>Instansi</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($peserta as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->diklat_name }}</td>
                    <td>{{ $item->institution }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->start_date)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->end_date)->format('d M Y') }}</td>
                    <td>
                        <!-- Tombol Edit -->
                        {{-- <a href="{{ route('peserta.edit', $item->id) }}" class="btn btn-sm btn-warning"> --}}
                            <i class='bx bxs-edit-alt'></i>
                        </a>

                        <!-- Tombol Delete -->
                        {{-- <form action="{{ route('peserta.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')"> --}}
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class='bx bxs-trash'></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada peserta.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>



