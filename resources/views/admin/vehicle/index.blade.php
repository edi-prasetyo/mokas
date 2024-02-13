@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-start">
                <h4 class="my-auto">Products</h4>
                <a href="{{ url('admin/products/create') }}" class="btn btn-success text-white">Add Product</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th scope="col">Category</th>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">status</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($vehicles as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td> {{ $data->category_name }}</td>
                                <td>{{ $data->title }}</td>
                                <td>{{ $data->price }}</td>
                                <td>{{ $data->views }}</td>
                                <td>
                                    @if ($data->status == 1)
                                        <span class="badge bg-light-success text-success">Active</span>
                                    @else
                                        <span class="badge bg-light-danger text-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('/jual-' . $data->category_slug . '/' . $data->slug) }}"
                                        class="btn btn-sm btn-success text-white">Lihat
                                        Iklan</a>
                                    <a href="{{ url('admin/vehicles/show/' . $data->id) }}"
                                        class="btn btn-sm btn-danger text-white">detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No Product Available </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>

            <div class="col-md-12 ps-5 pe-5">
                {{ $vehicles->links() }}
            </div>

        </div>
    </div>
@endsection
