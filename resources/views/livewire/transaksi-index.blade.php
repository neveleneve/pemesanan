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
    @include('layouts.data-per-page')
    <div class="row" wire:loading wire:loading.class='d-block' wire:target.except="transaksiDetail">
        <div class="col-12">
            <h1 class="text-center">
                <i class="fas fa-spinner-third fa-spin"></i>
            </h1>
        </div>
    </div>
    <div class="row" wire:loading.remove wire:target.except="transaksiDetail">
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
                                                        <button class="dropdown-item fw-bold" data-bs-toggle="modal"
                                                            data-bs-target="#modalView"
                                                            wire:click='transaksiDetail({{ $item->id }})'>
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
                                <td colspan="7">
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
            {{ $transaksi->links('layouts.pagination') }}
        </div>
    </div>
    <div class="modal fade" id="modalView" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold">Detail Transaksi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3 text-center">
                        <div class="col-12 mb-1">
                            <label for="kode" class="fw-bold">Kode Transaksi</label>
                            <input type="text" id="kode" readonly
                                value="{{ isset($selectedTrx->kode) ? $selectedTrx->kode : '' }}"
                                class="form-control form-control-sm form-control-plaintext text-center">
                        </div>
                        <div class="col-12 mb-1">
                            <label for="nama" class="fw-bold">Nama Customer</label>
                            <input type="text" id="nama" readonly
                                value="{{ isset($selectedTrx->nama) ? $selectedTrx->nama : '' }}"
                                class="form-control form-control-sm form-control-plaintext text-center">
                        </div>
                        <div class="col-12 mb-1">
                            <label for="meja" class="fw-bold">Meja</label>
                            <input type="text" id="meja" readonly
                                value="{{ isset($selectedTrx->meja->nama) ? $selectedTrx->meja->nama : '' }}"
                                class="form-control form-control-sm form-control-plaintext text-center">
                        </div>
                        <div class="col-12 mb-1">
                            <label for="total" class="fw-bold">Total</label>
                            <input type="text" id="total" readonly
                                value="Rp {{ isset($selectedTrx->total) ? number_format($selectedTrx->total, 0, ',', '.') : '' }}"
                                class="form-control form-control-sm form-control-plaintext text-center">
                        </div>
                    </div>
                    <table class="table table-hover table-bordered text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Nama</th>
                                <th>Qty</th>
                                <th>Status</th>
                                <th class="text-end">Harga</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($details as $detail)
                                <tr>
                                    <td>{{ $detail->menu->nama }}</td>
                                    <td>{{ $detail->qty }}</td>
                                    <td>{{ $detail->status ? 'Selesai' : 'Proses' }}</td>
                                    <td class="text-end">Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                    <td class="text-end">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <h3 class="text-center fw-bold">Data Kosong</h3>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">
                                    <h3 class="text-end fw-bold h6">Total</h3>
                                </td>
                                <td colspan="3" class="text-end">
                                    Rp
                                    {{ isset($selectedTrx->total) ? number_format($selectedTrx->total, 0, ',', '.') : '' }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    {{-- {{ $selectedTrx }} --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-danger fw-bold"
                        data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
