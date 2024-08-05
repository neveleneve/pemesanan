@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-bg-dark">
                        <h3 class="text-center">Menu dan Pemesanan</h3>
                    </div>
                    <div class="card-body">

                        @livewire('pemesanan-table', ['data' => $data])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
