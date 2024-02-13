@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">

                <div class="card">
                    <div class="card-header bg-white">
                        <h4>Edit Paket</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form action="{{ url('admin/packages/' . $package->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $package->name }}"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi Paket</label>
                                    <input type="text" name="description_period" class="form-control"
                                        value="{{ $package->description_period }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi Iklan</label>
                                    <input type="text" name="description_ads" class="form-control"
                                        value="{{ $package->description_ads }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jumlah Iklan</label>
                                    <input type="text" name="count" class="form-control" value="{{ $package->count }}"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Harga</label>
                                    <input type="text" name="price" class="form-control" value="{{ $package->price }}"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Icon ( ti ti-icon_name )</label>
                                    <input type="text" name="icon" class="form-control" value="{{ $package->icon }}"
                                        required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Lama Paket Aktif (hari)</label>
                                        <input type="text" name="active_period" class="form-control"
                                            value="{{ $package->active_period }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Lama Iklan Aktif (hari)</label>
                                        <input type="text" name="ads_period" class="form-control"
                                            value="{{ $package->ads_period }}" required>
                                    </div>
                                </div>

                                <div class="mb-3 mt-5">
                                    <div class="col-md-6">
                                        <div class="form-check form-switch">
                                            <label class="form-check-label">Highlight</label>
                                            <input class="form-check-input" type="checkbox" name="status"
                                                {{ $package->highlight == '1' ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 mt-3">
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
