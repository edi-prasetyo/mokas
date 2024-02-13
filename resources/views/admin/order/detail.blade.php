@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12 mb-4">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="card shadow-sm border-0">
                <div class="card-body row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="textmuted fw-bold h6 mb-0">Total Payment</p>
                                <p class="h1 fw-bold d-flex"> Rp. {{ number_format($order->price) }}
                                </p>
                                @if ($order->status == 0)
                                    <span class="badge bg-danger">Pending</span>
                                @else
                                    <span class="badge bg-warning">Completed</span>
                                @endif

                                <div class="mt-3">
                                    @if ($order->status == 0)
                                        <form action="{{ url('admin/orders/confirmation/' . $order->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="payment_status" value="1">
                                            <input type="hidden" name="status" value="2">
                                            <button type="submit" class="btn btn-success">Aprove</button>
                                        </form>
                                    @elseif($order->status == 1)
                                    @else
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <p class="p-blue"></span>No. Invoice : #{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</p>
                        Tanggal Order : <span
                            class="text-danger">{{ date('d M Y', strtotime($order->created_at)) }}</span><br>
                        Nama Customer : {{ $order->user_name }} <br>
                        Whatsapp : {{ $order->user_phone }}

                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mb-4">
            <div class="card">
                <div class="table-responsive text-nowrap">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th> Status</th>

                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">

                            <tr>
                                <td>{{ $order->created_at }}</td>
                                <td>
                                    <span class="fw-semibold lh-1">{{ $order->package_name }}</span>
                                </td>

                                <td>
                                    <div class="lh-1"><span class="text-primary fw-semibold">Rp.
                                            {{ number_format($order->price) }}</span></div>

                                </td>
                                <td>
                                    @if ($order->status == 0)
                                        <span class="badge bg-danger">Pending</span>
                                    @else
                                        <span class="badge bg-success">Completed</span>
                                    @endif
                                </td>

                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
