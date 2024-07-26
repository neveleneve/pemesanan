<div>
    <div class="row mb-3">
        <div class="col-lg-6 mb-lg-0 mb-3">
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
    <div class="row" wire:loading wire:loading.class='d-block' wire:target.except='doneOrder'>
        <div class="col-12">
            <h1 class="text-center">
                <i class="fas fa-spinner-third fa-spin"></i>
            </h1>
        </div>
    </div>
    <div class="row mb-3" wire:loading.remove wire:target.except='doneOrder'>
        <div class="col-12">
            <ul class="nav nav-underline nav-justified" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold active" id="home-tab" data-bs-toggle="tab"
                        data-bs-target="#home-tab-pane" type="button" role="tab">
                        Makanan
                        <span class="badge text-bg-primary">{{ count($makanan) }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold" id="profile-tab" data-bs-toggle="tab"
                        data-bs-target="#profile-tab-pane" type="button" role="tab">
                        Minuman
                        <span class="badge text-bg-primary">{{ count($minuman) }}</span>
                    </button>
                </li>
            </ul>
        </div>
    </div>
    <div class="tab-content" id="myTabContent" wire:loading.remove wire:target.except='doneOrder'>
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" tabindex="0">
            <div class="row">
                <div class="col-12">
                    <h3 class="text-center fw-bold">Daftar Makanan</h3>
                </div>
                <div class="col-12 h-50">
                    <div class="table-wrapper table-responsive">
                        <table class="table table-bordered text-center text-nowrap">
                            <thead class="table-dark">
                                <tr>
                                    <th>No. Pesanan</th>
                                    <th>Nama Cust.</th>
                                    <th>Nama Menu</th>
                                    <th>Meja</th>
                                    <th>Qty.</th>
                                    @can('pesanan edit')
                                        <th>Aksi</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($makanan as $mkn)
                                    <tr>
                                        <td>{{ $mkn->transaksi->kode }}</td>
                                        <td>{{ $mkn->transaksi->nama }}</td>
                                        <td>{{ $mkn->menu->nama }}</td>
                                        <td>{{ $mkn->transaksi->meja->nama }}</td>
                                        <td>{{ $mkn->qty }}</td>
                                        @can('pesanan edit')
                                            <td>
                                                @if ($loop->index == 0)
                                                    <button class="btn btn-sm btn-outline-primary fw-bold"
                                                        wire:click='doneOrder({{ $mkn->id }})'>
                                                        Done
                                                    </button>
                                                @endif
                                            </td>
                                        @endcan
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <h3 class="text-center fw-bold">Pesanan Makanan Kosong</h3>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" tabindex="0">
            <div class="row">
                <div class="col-12">
                    <h3 class="text-center fw-bold">Daftar Minuman</h3>
                </div>
                <div class="col-12">
                    <div class="table-wrapper table-responsive">
                        <table class="table table-bordered text-center text-nowrap">
                            <thead class="table-dark">
                                <tr>
                                    <th>No. Pesanan</th>
                                    <th>Nama Cust.</th>
                                    <th>Nama</th>
                                    <th>Meja</th>
                                    <th>Qty</th>
                                    @can('pesanan edit')
                                        <th>Aksi</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($minuman as $mnm)
                                    <tr>
                                        <td>{{ $mnm->transaksi->kode }}</td>
                                        <td>{{ $mnm->transaksi->nama }}</td>
                                        <td>{{ $mnm->menu->nama }}</td>
                                        <td>{{ $mnm->transaksi->meja->nama }}</td>
                                        <td>{{ $mnm->qty }}</td>
                                        @can('pesanan edit')
                                            <td>

                                                @if ($loop->index == 0)
                                                    <button class="btn btn-sm btn-outline-primary fw-bold"
                                                        wire:click='doneOrder({{ $mnm->id }})'>
                                                        Done
                                                    </button>
                                                @endif
                                            </td>
                                        @endcan
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">
                                            <h3 class="text-center fw-bold">Pesanan Minuman Kosong</h3>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
</div>

@push('style')
    <style>
        .table-wrapper {
            max-height: 300px;
            overflow-y: auto;
        }
    </style>
@endpush

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Livewire.on('test', (data) => {
            Swal.fire({
                icon: data.data.icon,
                title: data.data.title,
                text: data.data.text,
            });
        });
    </script>
@endpush
