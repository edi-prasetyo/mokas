@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-white">
                    <h4>Create Brand {{ $category_name->name }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form action="{{ url('admin/category/brand') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="category_id" value="{{ $category_name->id }}">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <label class="form-check-label">Status</label>
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckDefault" name="status">
                                </div>
                            </div>


                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card">
                <table class="table">
                    <thead>
                        <tr>

                            <th scope="col">name</th>
                            <th scope="col">slug</th>
                            <th width="15%" scope="col">logo</th>
                            <th scope="col">Type</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $brand)
                            <tr>
                                <td>{{ $brand->name }}</td>
                                <td>{{ $brand->slug }}</td>
                                <td><img src="{{ $brand->image_url }}" class="img-fluid"> </td>
                                <td>
                                    <a href="{{ url('admin/category/brand/type/' . $brand->id) }}"
                                        class="btn btn-primary btn-sm text-white"> Type Mobil</a>

                                </td>
                                <td>
                                    <a href="{{ url('admin/category/edit-brand/' . $brand->id) }}"
                                        class="btn btn-primary btn-sm text-white"><i class="fa fa-edit"></i> </a>
                                    <a href="{{ url('admin/category/delete-brand/' . $brand->id) }}"
                                        class="btn btn-danger btn-sm text-white"><i class="fa fa-trash"></i> </a>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
