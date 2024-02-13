@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>

    @if ($errors->any())
        <div class="alert alert-warning">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-white">
                    <h4>Create Brand {{ $brand->name }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form action="{{ url('admin/category/brand/type/') }}" method="POST">
                            @csrf
                            <input type="hidden" name="brand_id" value="{{ $brand->id }}">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" required>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" required></textarea>
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
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($types as $type)
                            <tr>
                                <td>{{ $type->name }}</td>
                                <td>
                                    <a href="{{ url('admin/category/brand/type/delete/' . $type->id) }}"
                                        class="btn btn-sm btn-danger text-white">Delete</a>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
