@extends('layouts.admin')

@section('content')
    @if (session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-white">
                    <h4>Edit Brand {{ $brand->name }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form action="{{ url('admin/category/update-brand/' . $brand->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ $brand->name }}">
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
                                <img src="{{ $brand->image_url }}">
                            </div>
                            <div class="mb-3">
                                <div class="col-md-6">
                                    <div class="form-check form-switch">
                                        <label class="form-check-label">Status</label>
                                        <input class="form-check-input" type="checkbox" name="status"
                                            {{ $brand->status == '1' ? 'checked' : '' }}>
                                    </div>
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



    </div>
@endsection
