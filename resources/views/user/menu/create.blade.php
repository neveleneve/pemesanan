@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.navigation')
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @include('layouts.breadcrumb', ['list' => ['Menu', 'Tambah']])
                        <div class="row mb-3">
                            <div class="col-lg-6 mb-lg-0 mb-3">
                                <a href="{{ route('menu.index') }}" wire:navigate
                                    class="btn btn-sm btn-outline-danger fw-bold">
                                    <i class="fa-solid fa-circle-chevron-left"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                        <form action="{{ route('menu.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-2 col-form-label col-form-label-sm fw-bold">
                                    Nama Menu<span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text"
                                        class="form-control form-control-sm @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ old('nama') }}" placeholder="Nama Menu">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="tipe" class="col-sm-2 col-form-label col-form-label-sm fw-bold">
                                    Tipe Menu<span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <select class="form-select form-select-sm @error('tipe') is-invalid @enderror"
                                        name="tipe" id="tipe">
                                        <option value="" hidden>Pilih Tipe Menu</option>
                                        <option value="makanan" {{ old('tipe') == 'makanan' ? 'selected' : null }}>
                                            Makanan
                                        </option>
                                        <option value="minuman" {{ old('tipe') == 'minuman' ? 'selected' : null }}>
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
                                    Harga<span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <input type="number" step="1000" min="0"
                                        class="form-control form-control-sm @error('harga') is-invalid @enderror"
                                        id="harga" name="harga" value="{{ old('harga') }}" placeholder="Harga">
                                    @error('harga')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="image" class="col-sm-2 col-form-label col-form-label-sm fw-bold">
                                    Gambar
                                </label>
                                <div class="col-sm-10">
                                    <input type="file" name="gambar" id="image" placeholder="Gambar Menu"
                                        accept=".jpg,.jpeg,.png"
                                        class="form-control form-control-sm @error('image') is-invalid @enderror">
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-12 d-grid gap-2">
                                    <button class="btn btn-sm btn-outline-primary fw-bold" type="submit">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
