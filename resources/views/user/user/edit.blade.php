@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.navigation')
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @include('layouts.breadcrumb', ['list' => ['Pengguna', 'Edit']])
                        <div class="row mb-3">
                            <div class="col-lg-6 mb-lg-0 mb-3">
                                <a href="{{ route('user.index') }}" wire:navigate
                                    class="btn btn-sm btn-outline-danger fw-bold">
                                    <i class="fa-solid fa-circle-chevron-left"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                        <form action="{{ route('user.update', ['user' => $data->id]) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-2 col-form-label col-form-label-sm fw-bold">
                                    Nama
                                </label>
                                <div class="col-sm-10">
                                    <input type="text"
                                        class="form-control form-control-sm @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ $data->name }}" placeholder="Nama Menu">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="email" class="col-sm-2 col-form-label col-form-label-sm fw-bold">
                                    Email
                                </label>
                                <div class="col-sm-10">
                                    <input type="email"
                                        class="form-control form-control-sm @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ $data->email }}" placeholder="Email">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="role" class="col-sm-2 col-form-label col-form-label-sm fw-bold">
                                    Role
                                </label>
                                <div class="col-sm-10">
                                    <select name="role" id="role" class="form-select form-select-sm">
                                        @foreach ($role as $item)
                                            <option {{ $data->roles[0]->name == $item->name ? 'selected' : null }}
                                                value="{{ $item->name }}">
                                                {{ ucwords($item->name) }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
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
