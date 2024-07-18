@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-bg-dark">
                        <h3 class="text-center">Menu dan Pemesanan</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('transaksi.store') }}" method="post">
                            @csrf
                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-2 col-form-label col-form-label-sm fw-bold">
                                    Nama Customer<span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" id="nama" name="nama"
                                        placeholder="Nama Customer" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="meja" class="col-sm-2 col-form-label col-form-label-sm fw-bold">
                                    Meja<span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" id="meja" readonly
                                        required placeholder="Nama Customer" value="{{ $data->nama }}">
                                    <input type="hidden" name="meja_id" value="{{ $data->id }}">
                                    <input type="hidden" name="meja_token" value="{{ $data->token }}">
                                </div>
                            </div>
                            {{-- <div class="mb-3 row">
                                <label for="jenis_pembayaran" class="col-sm-2 col-form-label col-form-label-sm fw-bold">
                                    Jenis Pembayaran<span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <select name="jenis_pembayaran" id="jenis_pembayaran" class="form-select form-select-sm"
                                        required>
                                        <option value="cash">Pembayaran Cash</option>
                                        <option value="online">Pembayaran Online</option>
                                    </select>
                                </div>
                            </div> --}}
                            <div class="mb-3 row">
                                <div class="col-12 gap-2 d-grid">
                                    <button class="btn btn-sm btn-outline-dark fw-bold" type="submit">
                                        Pesan
                                    </button>
                                </div>
                            </div>
                            @livewire('pemesanan-table')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
