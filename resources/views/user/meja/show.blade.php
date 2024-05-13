@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layout.navigation')
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @include('layout.breadcrumb', ['list' => ['Meja', 'Lihat']])
                        <div class="row mb-3">
                            <div class="col-lg-6 mb-lg-0 mb-3">
                                <a href="{{ route('meja.index') }}" wire:navigate
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
                            <label for="token" class="col-sm-2 col-form-label col-form-label-sm fw-bold">
                                Token
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm form-control-plaintext"
                                    id="token" value="{{ $data->token }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
