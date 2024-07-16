@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.navigation')
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @include('layouts.breadcrumb', ['list' => ['Role', 'Edit']])
                        <div class="row mb-3">
                            <div class="col-lg-6 mb-lg-0 mb-3">
                                <a href="{{ route('user.index') }}" wire:navigate
                                    class="btn btn-sm btn-outline-danger fw-bold">
                                    <i class="fa-solid fa-circle-chevron-left"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                        <form action="{{ route('role.update', ['role' => $role->id]) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="mb-3 row">
                                <label for="name" class="col-lg-2 col-form-label col-form-label-sm fw-bold">
                                    Nama Role
                                </label>
                                <div class="col-lg-10">
                                    <input type="text"
                                        class="form-control form-control-sm @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ $role->name }}" placeholder="Nama Menu">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="permission" class="col-lg-2 col-form-label col-form-label-sm fw-bold">
                                    Hak Akses
                                </label>
                            </div>
                            <div class="mb-3 row">
                                @foreach ($permissions as $permission)
                                    @php
                                        $checked = $role->hasPermissionTo($permission) ? 'checked' : '';
                                    @endphp
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $permission->name }}"
                                                id="checkbox{{ $permission->id }}" name="permissions[]" {{ $checked }}>
                                            <label class="form-check-label" for="checkbox{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
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
