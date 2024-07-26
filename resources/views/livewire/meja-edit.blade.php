<div class="input-group">
    <button class="btn btn-outline-warning btn-sm" type="button" title="Generate New Token" wire:click='refreshed'>
        <i class="fa-solid fa-arrows-rotate" wire:loading.remove></i>
        <i class="fa-solid fa-arrows-rotate fa-spin" wire:loading></i>
    </button>
    <input type="text" class="form-control form-control-sm" id="token" placeholder="Token" readonly
        wire:loading.attr='disabled' wire:target='refreshed' wire:model.live='meja.token'>
</div>

@push('script')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4@5">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/livewire/livewire.js') }}"></script>
@endpush
