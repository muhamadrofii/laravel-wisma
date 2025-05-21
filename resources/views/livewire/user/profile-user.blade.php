@section('title', 'Profile')

<section class="py-5" style="margin-top: 8rem;">
    <div class="container d-flex justify-content-center">
        <div class="row w-100 justify-content-center" style="max-width: 700px;">
            <div class="col-md-3 d-flex justify-content-center align-items-start">
                <i class="bi bi-person-circle" style="font-size: 6rem; color: #6c757d;"></i>
            </div>

            <div class="col-md-9">
                <form wire:submit.prevent="updateProfileInformation" class="mb-6">
                    <div class="mb-4">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input type="text" id="name" wire:model.defer="name" class="form-control" placeholder="John Doe" required autofocus autocomplete="name">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <div class="input-group">
                            <input type="email" id="email" wire:model.defer="email" class="form-control" placeholder="email@example.com" required autocomplete="email">
                            <span class="input-group-text">@example.com</span>
                        </div>

                        @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                            <div class="mt-3">
                                <p class="text-warning">
                                    {{ __('Your email address is unverified.') }}
                                    <a href="#" wire:click.prevent="resendVerificationNotification" class="text-info">{{ __('Click here to re-send the verification email.') }}</a>
                                </p>

                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 text-success">
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
                        <x-action-message class="me-3" on="profile-updated" x-data="{ show: false }" x-init="@this.on('profile-updated', () => { show = true; new bootstrap.Modal(document.getElementById('savedModal')).show(); })">
                            {{ __('Saved.') }}
                        </x-action-message>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- <livewire:masterusers.create/> --}}

    <!-- Modal -->
    <div class="modal fade" id="savedModal" tabindex="-1" aria-labelledby="savedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="savedModalLabel">{{ __('Sukses') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
                </div>
                <div class="modal-body">
                    {{ __('Profil Kamu Telah Diperbarui.') }}
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button> --}}
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    Livewire.on('profile-updated', () => {
        const modal = new bootstrap.Modal(document.getElementById('savedModal'));
        modal.show();
    });
</script>
@endpush

