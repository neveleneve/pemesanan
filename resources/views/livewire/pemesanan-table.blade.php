<div>
    <div class="row">
        <div class="col-12 mb-3">
            <h3 class="text-center fw-bold">Menu Tersedia</h3>
            <hr>
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-nowrap">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3" class="text-bg-dark">
                                <h3 class="fw-bold text-center">
                                    Makanan
                                </h3>
                            </td>
                        </tr>
                        @forelse ($makanan as $makan)
                            <tr>
                                <td>{{ $makan->nama }}</td>
                                <td>Rp {{ number_format($makan->harga, 0, ',', '.') }}</td>
                                <td>
                                    <input type="number" class="form-control" name="qtyMenu[{{ $makan->id }}]"
                                        wire:model.live='qtyMakan.{{ $loop->index }}' min="0">
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
                            <td colspan="3" class="text-bg-dark">
                                <h3 class="fw-bold text-center">
                                    Minuman
                                </h3>
                            </td>
                        </tr>
                        @forelse ($minuman as $minum)
                            <tr>
                                <td>{{ $minum->nama }}</td>
                                <td>Rp {{ number_format($minum->harga, 0, ',', '.') }}</td>
                                <td>
                                    <input type="number" class="form-control" name="qtyMenu[{{ $minum->id }}]"
                                        wire:model.live='qtyMinum.{{ $loop->index }}' min="0">
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
