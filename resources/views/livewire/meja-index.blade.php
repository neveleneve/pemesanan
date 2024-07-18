<div>
    <div class="row mb-3">
        <div class="col-lg-6 mb-lg-0 mb-3">
            @can('meja create')
                <a href="{{ route('meja.create') }}" wire:navigate class="btn btn-sm btn-outline-success fw-bold">
                    <i class="fa-solid fa-circle-plus"></i>
                    Tambah
                </a>
            @endcan
            <button wire:click='$refresh' class="btn btn-sm btn-outline-warning fw-bold">
                <i class="fa-solid fa-spinner-third fa-spin" wire:loading></i>
                Refresh
            </button>
        </div>
        <div class="col-lg-6">
            <input placeholder="Pencarian..." type="text" class="form-control form-control-sm border-bottom"
                wire:model.live='search'>
        </div>
    </div>
    @include('layouts.data-per-page')
    <div class="row" wire:loading wire:loading.class='d-block'>
        <div class="col-12">
            <h1 class="text-center">
                <i class="fas fa-spinner-third fa-spin"></i>
            </h1>
        </div>
    </div>
    <div class="row" wire:loading.remove>
        <div class="col-12">
            <div class="table-responsive-lg">
                <table class="table table-hover text-nowrap">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama</th>
                            @canany(['meja show', 'meja edit', 'meja delete'])
                                <th></th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($meja as $item)
                            <tr class="{{ $item->deleted_at ? 'table-danger' : null }}"
                                title="{{ $item->deleted_at ? 'Data sudah dihapus' : null }}">
                                <td>{{ $item->nama }}</td>
                                @canany(['meja show', 'meja edit', 'meja delete'])
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-primary fw-bold dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown">
                                                Aksi
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    {{-- <a href="{{ route('meja.qr', ['meja' => $item->id]) }}"
                                                        class="dropdown-item fw-bold" wire:navigate>
                                                        Download QR Code
                                                    </a> --}}
                                                    <button class="dropdown-item fw-bold"
                                                        wire:click='qrCode({{ $item->id }})'>
                                                        Download QR Code
                                                    </button>
                                                </li>
                                                @can('meja show')
                                                    @if (!$item->deleted_at)
                                                        <li>
                                                            <a class="dropdown-item fw-bold" wire:navigate
                                                                href="{{ route('meja.show', ['meja' => $item->id]) }}">
                                                                Lihat
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endcan
                                                @can('meja edit')
                                                    @if (!$item->deleted_at)
                                                        <li>
                                                            <a class="dropdown-item fw-bold" wire:navigate
                                                                href="{{ route('meja.edit', ['meja' => $item->id]) }}">
                                                                Edit
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endcan
                                                @can('meja delete')
                                                    @if ($item->deleted_at)
                                                        <li>
                                                            <button class="dropdown-item fw-bold"
                                                                wire:click='restoreMeja("{{ $item->id }}")'>
                                                                Kembalikan Data
                                                            </button>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <a class="dropdown-item fw-bold"
                                                                href="{{ route('meja.destroy', ['meja' => $item->id]) }}"
                                                                data-confirm-delete="true">Hapus</a>
                                                        </li>
                                                    @endif
                                                @endcan
                                            </ul>
                                        </div>
                                    </td>
                                @endcanany
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <h3 class="text-center fw-bold">Data Kosong</h3>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            {{ $meja->links('layouts.pagination') }}
        </div>
    </div>
</div>

@push('script')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4@5">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/livewire/livewire.js') }}"></script>
@endpush
