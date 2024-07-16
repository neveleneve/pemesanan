@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.navigation')
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @include('layouts.breadcrumb', ['list' => ['Menu', 'Lihat']])
                        <div class="row mb-3">
                            <div class="col-lg-6 mb-lg-0 mb-3">
                                <a href="{{ route('menu.index') }}" wire:navigate
                                    class="btn btn-sm btn-outline-danger fw-bold">
                                    <i class="fa-solid fa-circle-chevron-left"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-2 col-form-label col-form-label-sm fw-bold">
                                Nama Menu
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm form-control-plaintext"
                                    id="nama" value="{{ $data->nama }}" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="tipe" class="col-sm-2 col-form-label col-form-label-sm fw-bold">
                                Tipe Menu
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm form-control-plaintext"
                                    id="tipe" value="{{ ucwords($data->tipe) }}" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="harga" class="col-sm-2 col-form-label col-form-label-sm fw-bold">
                                Harga
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm form-control-plaintext"
                                    id="harga" value="Rp {{ number_format($data->harga, 0, ',', '.') }}" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="status" class="col-sm-2 col-form-label col-form-label-sm fw-bold">
                                Status Ketersediaan
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm form-control-plaintext"
                                    id="status" value="{{ $data->status ? 'Tersedia' : 'Tidak tersedia' }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
