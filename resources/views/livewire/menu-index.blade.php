<div>
    <div class="row mb-3">
        <div class="col-lg-6 mb-lg-0 mb-3">
            @can('menu create')
                <a href="{{ route('menu.create') }}" wire:navigate class="btn btn-sm btn-outline-success fw-bold">
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
            {{ env('APP_URL') }} Halo
            <div class="table-responsive-lg">
                <table class="table table-hover text-nowrap">
                    <thead class="table-dark">
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Nama</th>
                            <th>Jenis</th>
                            <th>Harga</th>
                            @canany(['menu show', 'menu edit', 'menu delete'])
                                <th></th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($menu as $item)
                            <tr class="{{ $item->deleted_at ? 'table-danger' : null }}"
                                title="{{ $item->deleted_at ? 'Data sudah dihapus' : null }}">
                                <td class="text-center">
                                    @if ($item->status)
                                        <i class="fa-solid fa-circle-check text-success" title="Tersedia"></i>
                                    @else
                                        <i class="fa-solid fa-circle-x text-danger" title="Tidak tersedia"></i>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($item->images != null)
                                        <img src="{{ url('images/menu/' . $item->images) }}"
                                            class="img-fluid img-thumbnail" width="70">
                                    @else
                                        <img src="{{ url('images/menu/default.png' . $item->images) }}"
                                            class="img-fluid img-thumbnail" width="70">
                                    @endif
                                </td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ ucwords($item->tipe) }}</td>
                                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                @canany(['menu show', 'menu edit', 'menu delete'])
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-primary fw-bold dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown">
                                                Aksi
                                            </button>
                                            <ul class="dropdown-menu">
                                                @can('menu show')
                                                    @if (!$item->deleted_at)
                                                        <li>
                                                            <a class="dropdown-item fw-bold" wire:navigate
                                                                href="{{ route('menu.show', ['menu' => $item->id]) }}">
                                                                Lihat
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endcan
                                                @can('menu edit')
                                                    @if (!$item->deleted_at)
                                                        <li>
                                                            <a class="dropdown-item fw-bold" wire:navigate
                                                                href="{{ route('menu.edit', ['menu' => $item->id]) }}">
                                                                Edit
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endcan
                                                @can('menu delete')
                                                    @if ($item->deleted_at)
                                                        <li>
                                                            <button class="dropdown-item fw-bold"
                                                                wire:click='restoreMenu("{{ $item->id }}")'>
                                                                Kembalikan Data
                                                            </button>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <a class="dropdown-item fw-bold"
                                                                href="{{ route('menu.destroy', ['menu' => $item->id]) }}"
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
                                <td colspan="10">
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
            {{ $menu->links('layouts.pagination') }}
        </div>
    </div>
</div>

@push('script')
    {{-- <link rel="stylesheet" href="{{ asset('assets/sweetalert/css/all.min.css') }}">
    <script src="{{ asset('assets/sweetalert/js/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/livewire/livewire.js') }}"></script> --}}
@endpush
