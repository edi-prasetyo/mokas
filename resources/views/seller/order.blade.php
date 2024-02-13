@extends('layouts.app')

@section('content')
    @include('layouts.inc.frontend.header')

    <div class="container">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    Paket Iklan saya
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($orders as $order)
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h3>Paket Kuota : {{ $order->package_name }}</h3>
                                        Tanggal Aktif : {{ $order->active_at }}<br>
                                        Tanggal Berakhir : {{ $order->expired_at }}<br>
                                        Invoice : INV-{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-6 text-center border-end">
                                                {{ $order->count }}<br>
                                                Tersedia
                                            </div>
                                            <div class="col-6 text-center">
                                                0<br>
                                                Digunakan

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
