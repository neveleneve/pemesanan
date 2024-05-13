@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layout.navigation')
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @include('layout.breadcrumb', ['list' => ['Meja', 'Tambah']])
                        <div class="row mb-3">
                            <div class="col-lg-6 mb-lg-0 mb-3">
                                <a href="{{ route('meja.index') }}" wire:navigate
                                    class="btn btn-sm btn-outline-danger fw-bold">
                                    <i class="fa-solid fa-circle-chevron-left"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                        @livewire('meja-create')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
