<div>
    <h4>Edit Status Order</h4>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="update">
        <!-- ID Invoice -->
        <div class="mb-3">
            <label class="form-label">ID Invoice</label>
            <input type="text" class="form-control" value="{{ $order->id }}" readonly>
        </div>

        <!-- Nama -->
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" value="{{ $order->name }}" readonly>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select wire:model="status" class="form-select">
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Jatuh Tempo -->
        <div class="mb-3">
            <label for="jatuh_tempo" class="form-label">Jatuh Tempo</label>
            <input type="datetime-local" wire:model="jatuh_tempo" class="form-control">
            @error('jatuh_tempo') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('masterorder') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
