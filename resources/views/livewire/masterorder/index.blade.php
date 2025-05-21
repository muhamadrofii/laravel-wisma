<div>
    <h4>Daftar Order</h4>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No Transaksi</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Grand Total</th>
                <th>Jumlah Hari</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Jatuh Tempo</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->no_transaction }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        Rp{{ number_format($order->grand_total ?? $order->price, 2, ',', '.') }}
                    </td>

                    <td>{{ $order->jumlah_hari ?? '-' }}</td>
                    <td>{{ $order->checkin ? \Carbon\Carbon::parse($order->checkin)->format('d-m-Y') : '-' }}</td>
                    <td>{{ $order->checkout ? \Carbon\Carbon::parse($order->checkout)->format('d-m-Y') : '-' }}</td>
                    <td>{{ $order->jatuh_tempo ? \Carbon\Carbon::parse($order->jatuh_tempo)->format('d-m-Y H:i') : '-' }}</td>
                    <td>
                        <a href="{{ route('masterorder.edit', $order->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <button class="btn btn-sm btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal"
                                wire:click="selectOrder('{{ $order->id }}')">
                            Hapus
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Konfirmasi Hapus</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            Yakin ingin menghapus order ini?
          </div>
          <div class="modal-footer">
            <button wire:click="delete" class="btn btn-danger">Hapus</button>
            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          </div>
        </div>
      </div>
    </div>
</div>

<script>
    window.addEventListener('closeModal', () => {
        var delModal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));

        if (delModal) delModal.hide();
    });
</script>
