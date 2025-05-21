<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="upload" enctype="multipart/form-data">
        <input type="file" wire:model="photo" class="form-control mb-2">

        @error('photo') <span class="text-danger">{{ $message }}</span> @enderror

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
