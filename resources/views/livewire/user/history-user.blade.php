<div class="container" style="margin-top: 8rem;">

    <h4>Riwayat Pemesanan</h4>

    <table class="table table-bordered table-hover mt-3">
        <thead class="table-dark">
            <tr>
                <th>No Transaksi</th>
                <th>Item</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Status</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Kamar</th>
                <th>Aksi</th>   {{-- ganti judul kolom --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->no_transaction }}</td>
                    <td>{{ $order->item_name }}</td>
                    <td>{{ $order->qty }}</td>
                    <td>
                        Rp{{ number_format($order->price, 0, ',', '.') }}
                    </td>
                    <td>
                        @php
                            $status = strtolower($order->status);
                            $badge  = match($status) {
                                'completed' => 'success',
                                'failed'    => 'danger',
                                'pending'   => 'warning',
                                'terjadwal' => 'info',
                                default     => 'secondary',
                            };
                        @endphp
                        <span class="badge bg-{{ $badge }}">{{ ucfirst($status) }}</span>
                    </td>
<td>{{ $order->checkin ? \Carbon\Carbon::parse($order->checkin)->format('d M Y') : '-' }}</td>
<td>{{ $order->checkout ? \Carbon\Carbon::parse($order->checkout)->format('d M Y') : '-' }}</td>

                    <td>{{ $order->kamar->nomor_kamar ?? '-' }}</td>
                    <td>
                        <button
                            class="btn btn-sm btn-primary mb-1"
                            wire:click="showInvoice('{{ $order->invoice_url }}')">
                            Invoice
                        </button>
                        <button
                            class="btn btn-sm btn-secondary"
                            wire:click="showBarcode('{{ $order->id }}')">
                            Barcode
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- =========== MODAL INVOICE =========== --}}
    <div wire:ignore.self class="modal fade" id="invoiceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @if ($selectedInvoiceUrl)
                        <iframe src="{{ $selectedInvoiceUrl }}" width="100%" height="500" frameborder="0"></iframe>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- =========== MODAL BARCODE =========== --}}
    <div wire:ignore.self class="modal fade" id="barcodeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Barcode Check-in</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <p class="fw-semibold mb-3">
                        Silakan tunjukkan barcode saat check-in.
                    </p>

                    @if ($selectedOrder)
                        {{-- QR-code base64 --}}
                        <img
                            src="data:image/png;base64,{{
                                DNS2D::getBarcodePNG($selectedOrder->external_id, 'QRCODE')
                            }}"
                            alt="QR Code"
                            class="img-fluid mb-2"
                        >
                        <p class="small text-muted">{{ $selectedOrder->external_id }}</p>
                    @else
                        <p class="text-danger">Barcode tidak tersedia.</p>
                    @endif

                    <button class="btn btn-outline-secondary btn-sm" onclick="window.print()">
                        Cetak
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    window.addEventListener('show-invoice-modal', () => {
        new bootstrap.Modal('#invoiceModal').show();
    });
    window.addEventListener('show-barcode-modal', () => {
        new bootstrap.Modal('#barcodeModal').show();
    });
</script>
@endpush
