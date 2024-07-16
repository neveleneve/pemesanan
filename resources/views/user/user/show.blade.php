@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.navigation')
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @include('layouts.breadcrumb', ['list' => ['Pengguna', 'Lihat']])
                        <div class="row mb-3">
                            <div class="col-lg-6 mb-lg-0 mb-3">
                                <a href="{{ route('user.index') }}" wire:navigate
                                    class="btn btn-sm btn-outline-danger fw-bold">
                                    <i class="fa-solid fa-circle-chevron-left"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-2 col-form-label col-form-label-sm fw-bold">
                                Nama
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm form-control-plaintext"
                                    id="nama" value="{{ $data->name }}" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-2 col-form-label col-form-label-sm fw-bold">
                                Email
                            </label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control form-control-sm form-control-plaintext"
                                    id="email" value="{{ $data->email }}" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="role" class="col-sm-2 col-form-label col-form-label-sm fw-bold">
                                Role
                            </label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control form-control-sm form-control-plaintext"
                                    id="role" value="{{ ucwords($data->roles[0]->name) }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
