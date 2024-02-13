@extends('layouts.app')

@section('content')
    @include('layouts.inc.frontend.header')

    <div class="container">



        <div class="container mt-5 mb-3">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">

                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="d-flex flex-row p-2">
                            <div class="d-flex flex-column">
                                <h2><span class="font-weight-bold">Invoice</span></h2>
                                <small>INV-{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</small>
                            </div>
                        </div>


                        <hr>
                        <div class="products p-2">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr class="add">
                                        <td>Description</td>
                                        <td>Days</td>
                                        <td>Price</td>

                                    </tr>
                                    <tr class="content">
                                        <td>{{ $order->package_name }}</td>
                                        <td>{{ $order->count }}</td>
                                        <td>{{ number_format($order->price) }}</td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>

                        <div class="p-3">

                            Transfer Ke nomor Rekening
                            <div class="alert alert-success">
                                @foreach ($banks as $bank)
                                    <div class="col-md-6">
                                        <div class="col-md-6">
                                            <img src="{{ $bank->image_url }}" class="img-fluid" width="20%">
                                        </div>
                                        <h2 class="mt-3">{{ $bank->number }}</h2>
                                        <p>{{ $bank->account }}</p>
                                    </div>
                                @endforeach
                            </div>

                            <a href="https://wa.me/{{ $option_nav->whatsapp }}" class="btn btn-success"> <i
                                    class="ti ti-brand-whatsapp"></i> Konfirmasi
                                Pembayaran</a>


                        </div>
                    </div>
                </div>
            </div>
        </div>








    </div>
@endsection
