@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layout.navigation')
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @include('layout.breadcrumb', ['list' => ['Menu']])
                        @livewire('menu-index')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
