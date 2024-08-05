@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-bg-dark">
                        <h3 class="text-center fw-bold">Pesanan {{ $data->kode }}</h3>
                        {{-- <h2 class="text-center fw-bold h5"></h2> --}}
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="nama" class="col-12 col-form-label col-form-label-sm fw-bold text-center">
                                Nama Customer
                            </label>
                            <div class="col-12">
                                <input type="text" class="form-control form-control-sm text-center" id="nama"
                                    readonly value="{{ $data->nama }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="meja" class="col-12 col-form-label col-form-label-sm fw-bold text-center">
                                Meja
                            </label>
                            <div class="col-12">
                                <input type="text" class="form-control form-control-sm text-center" id="meja"
                                    readonly value="{{ $data->meja->nama }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="jenis_pembayaran"
                                class="col-12 col-form-label col-form-label-sm fw-bold text-center">
                                Jenis Pembayaran
                            </label>
                            <div class="col-12">
                                <input type="text" class="form-control form-control-sm text-center" id="jenis_pembayaran"
                                    readonly value="{{ ucwords($data->jenis_pembayaran) }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="total" class="col-12 col-form-label col-form-label-sm fw-bold text-center">
                                Jenis Pembayaran
                            </label>
                            <div class="col-12">
                                <input type="text" class="form-control form-control-sm text-center" id="total"
                                    readonly value="Rp {{ number_format($data->total, 0, ',', '.') }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="tanggal" class="col-12 col-form-label col-form-label-sm fw-bold text-center">
                                Tanggal Pemesanan
                            </label>
                            <div class="col-12">
                                <input type="text" class="form-control form-control-sm text-center" id="tanggal"
                                    readonly value="{{ date('d F Y, H:i', strtotime($data->created_at)) }}">
                            </div>
                        </div>
                        @if ($data->jenis_pembayaran == 'online' && $data->status_bayar == 0)
                            <div class="mb-3 row">
                                <div class="col-12 d-grid gap-2">
                                    <button class="btn-sm btn btn-outline-dark fw-bold">
                                        Bayar
                                    </button>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-12">
                                <b class="text-dark">
                                    Estimasi Waktu :
                                </b>
                                {{ round($detailtrx * 2.5) }} Menit
                                <div class="table-responsive">
                                    <table class="table table-hover text-center">
                                        <thead class="table-dark fw-bold">
                                            <tr>
                                                <th>Nama</th>
                                                <th>Harga</th>
                                                <th>Qty</th>
                                                <th>Status</th>
                                                <th class="text-end">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->detail_transaksi as $item)
                                                <tr>
                                                    <td>{{ $item->menu->nama }}</td>
                                                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>{{ $item->status ? 'Selesai' : 'Proses' }}</td>
                                                    <td class="text-end">
                                                        Rp {{ number_format($item->harga * $item->qty, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot class="table-dark">
                                            <tr>
                                                <td class="text-end fw-bold" colspan="4">
                                                    Total
                                                </td>
                                                <td class="text-end">
                                                    Rp {{ number_format($data->total, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
