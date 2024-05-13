<div>
    <div class="row mb-3">
        <div class="col-lg-6 mb-lg-0 mb-3">
            @can('transaksi create')
                @if (Route::has('transaksi.create'))
                    <a href="{{ route('transaksi.create') }}" wire:navigate class="btn btn-sm btn-outline-success fw-bold">
                        <i class="fa-solid fa-circle-plus"></i>
                        Tambah
                    </a>
                @endif
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
    @include('layout.data-per-page')
    <div class="row" wire:loading wire:loading.class='d-block'>
        <div class="col-12">
            <h1 class="text-center">
                <i class="fas fa-spinner-third fa-spin"></i>
            </h1>
        </div>
    </div>
    <div class="row" wire:loading.remove>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                    <thead class="table-dark">
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Meja</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                            @canany(['transaksi show', 'transaksi edit', 'transaksi delete'])
                                <th></th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaksi as $item)
                            <tr>
                                <td>{{ $item->kode }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->meja->nama }}</td>
                                <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                                <td>{{ date('d F Y. H:i:s', strtotime($item->created_at)) }}</td>
                                @canany(['transaksi show', 'transaksi edit', 'transaksi delete'])
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-primary fw-bold dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown">
                                                Aksi
                                            </button>
                                            <ul class="dropdown-menu">
                                                @can('transaksi show')
                                                    <li>
                                                        <button class="dropdown-item fw-bold">
                                                            Lihat Detail Transaksi
                                                        </button>
                                                    </li>
                                                @endcan
                                                @can('transaksi edit')
                                                    @if (Route::has('transaksi.destroy'))
                                                        <li>
                                                            <a class="dropdown-item fw-bold" wire:navigate
                                                                href="{{ route('menu.edit', ['menu' => $item->id]) }}">
                                                                Edit
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endcan
                                                @can('transaksi delete')
                                                    @if (Route::has('transaksi.destroy'))
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
                                <td colspan="3">
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
            {{ $transaksi->links('layout.pagination') }}
        </div>
    </div>
</div>
