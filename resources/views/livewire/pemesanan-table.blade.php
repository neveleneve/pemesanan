<div>
    @csrf
    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label col-form-label-sm fw-bold">
            Nama Customer<span class="text-danger">*</span>
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
            Total Pesanan<span class="text-danger">*</span>
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
                {{-- {{ $this->grandTotal() > 0 && $this->nama != '' ? null : 'disabled' }}> --}}
                Pesan
            </button>
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
                                <button type="button" class="btn btn-sm btn-outline-secondary fw-bold"
                                    data-bs-dismiss="modal">
                                    Batal
                                </button>
                                <button class="btn btn-sm btn-outline-primary fw-bold" type="submit">
                                    Lanjut
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
            <h3 class="text-center fw-bold">Menu Tersedia</h3>
            <hr>
            <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                    <thead class="table-dark">
                        <tr>
                            <th></th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Qty</th>
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
                                            class="img-fluid img-thumbnail" width="70">
                                    @else
                                        <img src="{{ url('images/menu/default.png' . $makan['images']) }}"
                                            class="img-fluid img-thumbnail" width="70">
                                    @endif
                                </td>
                                <td>{{ $makan->nama }}</td>
                                <td>Rp {{ number_format($makan->harga, 0, ',', '.') }}</td>
                                <td>
                                    <input type="number" class="form-control" min="0"
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
    </div>
</div>
