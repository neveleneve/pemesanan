@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.navigation')
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 mb-lg-0 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h3>Jumlah Pesanan Makanan Hari Ini</h3>
                        <h5>{{ $todayFood }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h3>Jumlah Pesanan Minuman Hari Ini</h3>
                        <h5>{{ $todayDrink }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
