@extends('layouts.admin')

@section('content')
<div class="col-md-12">
    @if(session('message'))
    <div class="col-md-12">
        <div class="alert alert-success">
            {{session('message')}}
        </div>
    </div>
    @endif
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-start">
            <h4 class="my-auto">Brand</h4>
            <a href="{{url('admin/brands/create')}}" class="btn btn-success text-white">Add brand</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th scope="col">user</th>
                        <th scope="col">amount</th>
                        <th scope="col">Status</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($topups as $data)
                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->user_name}}</td>
                        <td>{{number_format($data->amount)}}</td>
                        <td>
                            @if($data->status == 1)
                            <span class="badge bg-light-success text-success">Success</span>
                            @else
                            <span class="badge bg-light-danger text-danger">Pending</span>
                            @endif

                        </td>
                        <td>
                            <a href="{{url('admin/topups/show/' .$data->id)}}"
                                class="btn btn-sm btn-primary text-white">Edit</a>
                            <a href="#" wire:click="deleteBrand({{$data->id}})" class="btn btn-sm btn-danger text-white"
                                data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <div class="col-md-12 mt-5">
        {{$topups->links()}}
    </div>
</div>
@endsection