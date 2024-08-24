<div>
    @csrf
    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label col-form-label-sm fw-bold">
            Nama<span class="text-danger">*</span>
        </label>
        <div class="col-sm-10">
            <input type="text" class="form-control form-control-sm" id="name" wire:model.live='nama'
                placeholder="Nama Customer" required>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="meja" class="col-sm-2 col-form-label col-form-label-sm fw-bold">
            Meja<span class="text-danger">*</span>
        </label>
        <div class="col-sm-10">
            <input type="text" class="form-control form-control-sm" id="meja" readonly required
                placeholder="Nama Customer" value="{{ $data->nama }}">
            <input type="hidden" name="meja_id" value="{{ $data->id }}" wire:model.live='meja_id'>
            <input type="hidden" name="meja_token" value="{{ $data->token }}" wire:model.live='meja_token'>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="total" class="col-sm-2 col-form-label col-form-label-sm fw-bold">
            Total<span class="text-danger">*</span>
        </label>
        <div class="col-sm-10">
            <input type="text" class="form-control form-control-sm" id="total" readonly required
                placeholder="Total" value="Rp {{ number_format($this->grandTotal(), 0, ',', '.') }}">
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-12 gap-2 d-grid">
            <button class="btn btn-sm btn-outline-dark fw-bold" data-bs-toggle="modal" data-bs-target="#modalConfirm"
                {{ $this->nama != '' ? null : 'disabled' }}>
                Pesan
            </button>
            {{-- <button class="btn btn-sm btn-outline-dark fw-bold" data-bs-toggle="modal" data-bs-target="#modalMenu">
                Pesan
            </button> --}}
            <div class="modal modal-xl fade" id="modalConfirm" tabindex="-1" data-bs-backdrop="static">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalConfirmLabel">Konfirmasi Pesanan</h1>
                        </div>
                        <form action="{{ route('transaksi.store') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <label for="nama" class="fw-bold">Nama Customer</label>
                                <input type="text" name="nama" id="nama" value="{{ $nama }}"
                                    class="form-control form-control-sm mb-3">

                                <label for="meja" class="fw-bold">Meja</label>
                                <input type="text" class="form-control form-control-sm mb-3" id="meja_name" readonly
                                    required placeholder="Nama Meja" value="{{ $data->nama }}">
                                <input type="hidden" name="meja_id" value="{{ $data->id }}">
                                <input type="hidden" name="meja_token" value="{{ $data->token }}">

                                <label for="grandtotal" class="fw-bold">Total</label>
                                <input type="text" id="grandtotal" class="form-control form-control-sm mb-3"
                                    value="Rp {{ number_format($this->grandTotal(), 0, ',', '.') }}">
                                <input type="hidden" name="grandtotal" value="{{ $this->grandTotal() }}">
                                <hr>
                                <table class="table table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th></th>
                                            <th>Nama</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($qtyMakan as $makan)
                                            @if ($makan['qty'] != 0)
                                                <tr>
                                                    <td class="text-center">
                                                        @if ($makan['images'] != null)
                                                            <img src="{{ url('images/menu/' . $makan['images']) }}"
                                                                class="img-fluid img-thumbnail" width="70">
                                                        @else
                                                            <img src="{{ url('images/menu/default.png' . $makan['images']) }}"
                                                                class="img-fluid img-thumbnail" width="70">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $this->subTotal($makan['id'], $makan['qty'])['nama'] }}
                                                        <input type="hidden" name="qtyMenu[{{ $makan['id'] }}]"
                                                            value="{{ $makan['qty'] }}">
                                                    </td>
                                                    <td>
                                                        Rp
                                                        {{ number_format($this->subTotal($makan['id'], $makan['qty'])['harga'], 0, ',', '.') }}
                                                    </td>
                                                    <td>{{ $makan['qty'] }}</td>
                                                    <td>
                                                        Rp
                                                        {{ number_format($this->subTotal($makan['id'], $makan['qty'])['subtotal'], 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        @foreach ($qtyMinum as $minum)
                                            @if ($minum['qty'] != 0)
                                                <tr>
                                                    <td class="text-center">
                                                        @if ($minum['images'] != null)
                                                            <img src="{{ url('images/menu/' . $minum['images']) }}"
                                                                class="img-fluid img-thumbnail" width="70">
                                                        @else
                                                            <img src="{{ url('images/menu/default.png' . $minum['images']) }}"
                                                                class="img-fluid img-thumbnail" width="70">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $this->subTotal($minum['id'], $minum['qty'])['nama'] }}
                                                        <input type="hidden" name="qtyMenu[{{ $minum['id'] }}]"
                                                            value="{{ $minum['qty'] }}">
                                                    </td>
                                                    <td>
                                                        Rp
                                                        {{ number_format($this->subTotal($minum['id'], $minum['qty'])['harga'], 0, ',', '.') }}
                                                    </td>
                                                    <td>{{ $minum['qty'] }}</td>
                                                    <td>
                                                        Rp
                                                        {{ number_format($this->subTotal($minum['id'], $minum['qty'])['subtotal'], 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        <tr class="table-dark">
                                            <td colspan="4" class="text-end fw-bold">
                                                Total
                                            </td>
                                            <td>
                                                Rp
                                                {{ number_format($this->grandTotal(), 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm fw-bold btn-outline-danger"
                                    data-bs-dismiss="modal">
                                    Lanjut Piilih Menu
                                </button>
                                <button class="btn btn-sm btn-outline-primary fw-bold fw-bold" data-bs-dismiss="modal"
                                    type="submit">
                                    Konfirmasi Pemesanan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-3">
            <h3 class="text-center text-dark fw-bold">Menu Tersedia</h3>
            <hr>
        </div>
        <div class="col-12 mb-3">
            <h3 class="text-center fw-bold">Makanan</h3>
        </div>
        @forelse ($makanan as $makan)
            <div class="col-12 col-lg-3 mb-3">
                <div class="card">
                    @if ($makan['images'] != null)
                        <img src="{{ url('images/menu/' . $makan['images']) }}" class="card-img-top">
                    @else
                        <img src="{{ url('images/menu/default.png' . $makan['images']) }}" class="card-img-top">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-dark">{{ $makan->nama }}</h5>
                        <p class="card-text">
                            Rp {{ number_format($makan->harga, 0, ',', '.') }} x {{ $qtyMakan[$loop->index]['qty'] }}
                        </p>
                        <button class="btn btn-sm btn-outline-primary fw-bold" data-bs-toggle="modal"
                            data-bs-target="#modalMakan{{ $loop->index }}">
                            Pesan
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalMakan{{ $loop->index }}" tabindex="-1" wire:ignore.self
                data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Jumlah Pesanan Menu</h1>
                        </div>
                        <div class="modal-body">
                            <label class="fw-bold">Nama Menu</label>
                            <input type="text" class="form-control mb-3" value="{{ $makan->nama }}" readonly>
                            <label class="fw-bold">Jumlah Pesan</label>
                            <div class="input-group mb-3">
                                <button class="btn btn-outline-secondary" type="button"
                                    wire:click='valueChanger({{ $loop->index }}, "makan", "-")'>
                                    <i class="fa fa-minus"></i>
                                </button>
                                <input type="text" class="form-control" placeholder="Jumlah Pesanan"
                                    wire:model.live='qtyMakan.{{ $loop->index }}.qty'>
                                <button class="btn btn-outline-primary" type="button"
                                    wire:click='valueChanger({{ $loop->index }}, "makan", "+")'>
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm fw-bold btn-outline-danger"
                                data-bs-dismiss="modal" wire:click='cancelPesan("makan", {{ $loop->index }})'>
                                Batal
                            </button>
                            <button type="button" class="btn btn-sm fw-bold btn-outline-primary"
                                data-bs-dismiss="modal">
                                Konfirmasi Jumlah Pesan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <h3 class="fw-bold text-dark text-center">Makanan Kosong</h3>
            </div>
        @endforelse
        <hr>
        <div class="col-12 mb-3">
            <h3 class="text-center fw-bold">Minuman</h3>
        </div>
        @forelse ($minuman as $minum)
            <div class="col-12 col-lg-3 mb-3">
                <div class="card">
                    @if ($minum['images'] != null)
                        <img src="{{ url('images/menu/' . $minum['images']) }}" class="card-img-top">
                    @else
                        <img src="{{ url('images/menu/default.png' . $minum['images']) }}" class="card-img-top">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-dark">{{ $minum->nama }}</h5>
                        <p class="card-text">
                            Rp {{ number_format($minum->harga, 0, ',', '.') }} x {{ $qtyMinum[$loop->index]['qty'] }}
                        </p>
                        <button class="btn btn-sm btn-outline-primary fw-bold" data-bs-toggle="modal"
                            data-bs-target="#modalMinum{{ $loop->index }}">
                            Pesan
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalMinum{{ $loop->index }}" tabindex="-1" wire:ignore.self
                data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Jumlah Pesanan Menu</h1>
                        </div>
                        <div class="modal-body">
                            <label for="nama_menu" class="fw-bold">Nama Menu</label>
                            <input type="text" id="nama_menu" class="form-control mb-3"
                                value="{{ $minum->nama }}" readonly>
                            <label for="jml" class="fw-bold">Jumlah Pesan</label>
                            <div class="input-group mb-3">
                                <button class="btn btn-outline-secondary" type="button"
                                    wire:click='valueChanger({{ $loop->index }}, "minum", "-")'>
                                    <i class="fa fa-minus"></i>
                                </button>
                                <input type="text" class="form-control" placeholder="Jumlah Pesanan"
                                    wire:model.live='qtyMinum.{{ $loop->index }}.qty'>
                                <button class="btn btn-outline-primary" type="button"
                                    wire:click='valueChanger({{ $loop->index }}, "minum", "+")'>
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm fw-bold btn-outline-danger"
                                data-bs-dismiss="modal" wire:click='cancelPesan("minum", {{ $loop->index }})'>
                                Batal
                            </button>
                            <button type="button" class="btn btn-sm fw-bold btn-outline-primary"
                                data-bs-dismiss="modal">
                                Konfirmasi Jumlah Pesan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <h3 class="fw-bold text-dark text-center">Minuman Kosong</h3>
            </div>
        @endforelse
    </div>
    {{-- <div class="row">
        <div class="col-12 mb-3">
            <h3 class="text-center fw-bold">Menu Tersedia</h3>
            <hr>
            <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                    <thead class="table-dark">
                        <tr>
                            <th></th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4" class="text-bg-dark">
                                <h3 class="fw-bold text-center">
                                    Makanan
                                </h3>
                            </td>
                        </tr>
                        @forelse ($makanan as $makan)
                            <tr>
                                <td class="text-center">
                                    @if ($makan['images'] != null)
                                        <img src="{{ url('images/menu/' . $makan['images']) }}"
                                            data-bs-toggle="modal" data-bs-target="#modalMenu"
                                            class="img-fluid img-thumbnail" width="70">
                                    @else
                                        <img src="{{ url('images/menu/default.png' . $makan['images']) }}"
                                            data-bs-toggle="modal" data-bs-target="#modalMenu"
                                            class="img-fluid img-thumbnail" width="70">
                                    @endif
                                </td>
                                <td>{{ $makan->nama }}</td>
                                <td>Rp {{ number_format($makan->harga, 0, ',', '.') }}</td>
                                <td>
                                    <input type="number" class="form-control-plaintext" min="0"
                                        wire:model.live='qtyMakan.{{ $loop->index }}.qty'>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <h3 class="text-center fw-bold">Data Makanan Kosong</h3>
                                </td>
                            </tr>
                        @endforelse
                        <tr>
                            <td colspan="4" class="text-bg-dark">
                                <h3 class="fw-bold text-center">
                                    Minuman
                                </h3>
                            </td>
                        </tr>
                        @forelse ($minuman as $minum)
                            <tr>
                                <td class="text-center">
                                    @if ($minum['images'] != null)
                                        <img src="{{ url('images/menu/' . $minum['images']) }}"
                                            class="img-fluid img-thumbnail" width="70">
                                    @else
                                        <img src="{{ url('images/menu/default.png' . $minum['images']) }}"
                                            class="img-fluid img-thumbnail" width="70">
                                    @endif
                                </td>
                                <td>{{ $minum->nama }}</td>
                                <td>Rp {{ number_format($minum->harga, 0, ',', '.') }}</td>
                                <td>
                                    <input type="number" class="form-control" min="0"
                                        wire:model.live='qtyMinum.{{ $loop->index }}.qty'>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <h3 class="text-center fw-bold">Data Minuman Kosong</h3>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}
    {{-- <div class="modal fade" id="modalMenu" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Jumlah Pesanan Menu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="nama_menu" class="fw-bold">Nama Menu</label>
                    <input type="text" id="nama_menu" class="form-control mb-3" id="nama_menu">
                    <label for="jml" class="fw-bold">Jumlah Pesan</label>
                    <input type="number" class="form-control" id="jml" placeholder="Masukkan Jumlah Pesanan">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div> --}}

</div>
