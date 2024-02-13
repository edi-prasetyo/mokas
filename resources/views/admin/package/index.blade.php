@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">

                <div class="card">
                    <div class="card-header bg-white">
                        <h4>Buat Paket</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form action="{{ url('admin/packages') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi Paket</label>
                                    <input type="text" name="description_period" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi Iklan</label>
                                    <input type="text" name="description_ads" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jumlah Iklan</label>
                                    <input type="text" name="count" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Harga</label>
                                    <input type="text" name="price" class="form-control" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Lama Paket Aktif (hari)</label>
                                        <input type="text" name="active_period" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Lama Iklan Aktif (hari)</label>
                                        <input type="text" name="ads_period" class="form-control" required>
                                    </div>
                                </div>

                                <div class="mb-3 mt-5">
                                    <div class="form-check form-switch">
                                        <label class="form-check-label">Highlight</label>
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckDefault" name="status">
                                    </div>
                                </div>

                                <div class="mb-3 mt-3">
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-8">

                @if (session('message'))
                    <div class="col-md-12">
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-start">
                        <h4 class="my-auto">Paket</h4>
                        <a href="{{ url('admin/banks/create') }}" class="btn btn-success text-white">Add Bank</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($packages as $data)
                                    <tr>
                                        <td>{{ $data->name }}</td>
                                        <td>
                                            <a href="{{ url('admin/packages/edit/' . $data->id) }}"
                                                class="btn btn-sm btn-primary text-white">Edit</a>
                                            <a href="{{ url('admin/packages/delete/' . $data->id) }}"
                                                class="btn btn-sm btn-primary text-white">Delete</a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
