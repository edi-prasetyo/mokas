@extends('layouts.app')

@section('content')
    @include('layouts.inc.frontend.header')

    <div class="container">

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        <div class="row">

            <div class="col-md-8">
                <div class="d-grid gap-2 my-3">
                    <a href="{{ url('seller/create') }}" class="btn btn-success btn-lg"> <i class='bx bx-pencil'></i>
                        Pasang Iklan</a>
                </div>

                @if (empty($packages))
                @else
                    <a href="{{ url('seller/packages') }}" class="btn btn-success btn-lg"> <i class='bx bx-pencil'></i>
                        Beli Paket Iklan</a>
                @endif

                @foreach ($mypackages as $package)
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-header">
                            <h5 class="card-title text-muted mb-0">Paket {{ $package->package_name }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">

                                    <span class="h2 font-weight-bold mb-0">Tersisa <span class="text-success fw-bold">
                                            {{ $package->count }} </span> Iklan </span>

                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-success text-white rounded-circle">
                                        <i class="ti ti-box"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach

                <div class="card my-3">
                    <div class="card-header">
                        Iklan Saya
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Judul Iklan</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Berakhir Pada</th>
                                <th scope="col">Dilihat</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ads as $data)
                                <tr>
                                    <td>{{ $data->title }}</td>
                                    <td>{{ $data->price }}</td>
                                    <td>{{ $data->expired_at }}</td>
                                    <td>{{ $data->views }}</td>
                                    <td>
                                        <a href="" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="" class="btn btn-danger btn-sm">Terjual</a>
                                        <a href="{{ url('/jual-' . $data->category_slug . '/' . $data->slug) }}"
                                            class="btn btn-success btn-sm">lihat</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="col-md-4">
                <div class="card">Sidebar</div>
            </div>
        </div>
    </div>
@endsection
