@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.navigation')
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @include('layouts.breadcrumb', ['list' => ['Pengguna']])
                        @livewire('user-index')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
