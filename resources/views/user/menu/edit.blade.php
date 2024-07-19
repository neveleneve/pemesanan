@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.navigation')
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @include('layouts.breadcrumb', ['list' => ['Menu', 'Edit']])
                        <div class="row mb-3">
                            <div class="col-lg-6 mb-lg-0 mb-3">
                                <a href="{{ route('menu.index') }}" wire:navigate
                                    class="btn btn-sm btn-outline-danger fw-bold">
                                    <i class="fa-solid fa-circle-chevron-left"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                        <form action="{{ route('menu.update', ['menu' => $data->id]) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-2 col-form-label col-form-label-sm fw-bold">
                                    Nama Menu
                                </label>
                                <div class="col-sm-10">
                                    <input type="text"
                                        class="form-control form-control-sm @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ $data->nama }}" placeholder="Nama Menu"
                                        @role('dapur') readonly @endrole>
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="tipe" class="col-sm-2 col-form-label col-form-label-sm fw-bold">
                                    Tipe Menu
                                </label>
                                <div class="col-sm-10">
                                    <select class="form-select form-select-sm @error('tipe') is-invalid @enderror"
                                        name="tipe" id="tipe" @role('dapur') disabled @endrole>
                                        <option value="" hidden>Pilih Tipe Menu</option>
                                        <option value="makanan" {{ $data->tipe == 'makanan' ? 'selected' : null }}>
                                            Makanan
                                        </option>
                                        <option value="minuman" {{ $data->tipe == 'minuman' ? 'selected' : null }}>
                                            Minuman
                                        </option>
                                    </select>
                                    @error('tipe')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="harga" class="col-sm-2 col-form-label col-form-label-sm fw-bold">
                                    Harga
                                </label>
                                <div class="col-sm-10">
                                    <input type="number" step="1000"
                                        class="form-control form-control-sm @error('harga') is-invalid @enderror"
                                        id="harga" name="harga" value="{{ $data->harga }}" placeholder="Harga"
                                        @role('dapur') readonly @endrole>
                                    @error('harga')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="status" class="col-sm-2 col-form-label col-form-label-sm fw-bold">
                                    Status Ketersediaan
                                </label>
                                <div class="col-sm-10">
                                    <select class="form-select form-select-sm @error('status') is-invalid @enderror"
                                        name="status" id="status">
                                        <option value="" hidden>Pilih Status Ketersediaan</option>
                                        <option value="1" {{ $data->status == '1' ? 'selected' : null }}>
                                            Tersedia
                                        </option>
                                        <option value="0" {{ $data->status == '0' ? 'selected' : null }}>
                                            Tidak tersedia
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-12 d-grid gap-2">
                                    <button class="btn btn-sm btn-outline-primary fw-bold" type="submit">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
