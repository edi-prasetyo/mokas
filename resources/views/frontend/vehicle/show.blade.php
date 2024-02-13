@extends('layouts.app')
@section('title', 'Mobil Dijual')
@section('content')
    @include('layouts.inc.frontend.header')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-9">

                <div class="mb-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="carouselExampleIndicators" class="carousel slide bg-dark rounded" data-bs-ride="carousel">
                                <div class="carousel-inner rounded">
                                    @foreach ($images as $key => $slider)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <img src="{{ $slider->url }}" class="d-block w-100" alt="{{ $slider->title }}">
                                        </div>
                                    @endforeach
                                </div>

                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h2 class="fw-bold">{{ $vehicle->title }}</h2>
                            <h4 class="fw-bold">Rp. {{ number_format($vehicle->price) }}</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    Transmisi : <br>
                                    <b> <i class="ti ti-manual-gearbox"></i> {{ $vehicle->transmision }}</b> <br>
                                    Bahan Bakar : <br>
                                    <b><i class="ti ti-gas-station"></i> {{ $vehicle->fuel }}</b> <br>
                                    Kapasitas Mesin : <br>
                                    <b><i class="ti ti-engine"></i> {{ number_format($vehicle->engine_capacity) }} CC </b>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    Jarak Tempuh : <br>
                                    <b> <i class="ti ti-dashboard"></i> {{ $vehicle->odometer }} </b> <br>
                                    Tahun Kendaraan : <br>
                                    <b><i class="ti ti-calendar-time"></i> {{ $vehicle->year }} </b> <br>

                                </div>
                            </div>



                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="card">

                    <ul class="nav nav-pills mb-3 border-bottom" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#pills-home"
                                role="tab" aria-controls="pills-home" aria-selected="true">
                                Info Penjual</a>
                        </li>


                    </ul>

                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a class="btn btn-lg btn-success"
                                href="https://wa.me/{{ $vehicle->user_phone }}?text=I'm%20interested%20in%20your%20car%20for%20sale"><i
                                    class="ti ti-brand-whatsapp"></i> Hubungi Penjual</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="row">
            <div class="col-md-9 mt-5">
                <div class="form-search card shadow-sm d-flex justify-content-center">
                    <!-- nav options -->
                    <div class="">
                        <ul class="nav nav-pills mb-3 border-bottom" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#pills-home"
                                    role="tab" aria-controls="pills-home" aria-selected="true">
                                    Deskripsi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#pills-profile"
                                    role="tab" aria-controls="pills-profile" aria-selected="false"> Spesifikasi</a>
                            </li>

                        </ul>
                    </div>

                    <!-- content -->
                    <div class="tab-content" id="pills-tabContent p-3">
                        <!-- 1st card -->
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">

                            <div class="p-2">
                                {!! $vehicle->description !!}
                            </div>

                        </div>
                        <!-- 2nd card -->
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="p-5">
                                Spesifikasi
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <article class="card-group-item">
                        <header class="card-header">
                            <h6 class="title">Brands </h6>
                        </header>
                        <div class="filter-content">
                            <div class="card-body">
                                <form>
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" value="">
                                        <span class="form-check-label">
                                            Mersedes Benz
                                        </span>
                                    </label> <!-- form-check.// -->
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" value="">
                                        <span class="form-check-label">
                                            Nissan Altima
                                        </span>
                                    </label> <!-- form-check.// -->
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" value="">
                                        <span class="form-check-label">
                                            Another Brand
                                        </span>
                                    </label> <!-- form-check.// -->
                                </form>

                            </div> <!-- card-body.// -->
                        </div>
                    </article> <!-- card-group-item.// -->

                    <article class="card-group-item">
                        <header class="card-header">
                            <h6 class="title">Choose type </h6>
                        </header>
                        <div class="filter-content">
                            <div class="card-body">
                                <label class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadio" value="">
                                    <span class="form-check-label">
                                        First hand items
                                    </span>
                                </label>
                                <label class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadio" value="">
                                    <span class="form-check-label">
                                        Brand new items
                                    </span>
                                </label>
                                <label class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadio" value="">
                                    <span class="form-check-label">
                                        Some other option
                                    </span>
                                </label>
                            </div> <!-- card-body.// -->
                        </div>
                    </article> <!-- card-group-item.// -->
                </div> <!-- card.// -->


            </div>

        </div>
    </div>

@endsection
