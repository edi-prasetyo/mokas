@extends('layouts.app')
@section('title', 'Mobil Dijual')
@section('content')
    @include('layouts.inc.frontend.header')
    <div class="container my-5">
        <div class="row">

            <div class="col-md-9">
                <div class="row">
                    @forelse($vehicles as $item)
                        <div class="col-md-4">
                            <div class="card shadow-sm  mb-4">
                                <a href="{{ url('/jual-' . $item->category_slug . '/' . $item->slug) }}"
                                    class="position-relative">
                                    <div class="card-image-cover">
                                        <img src="{{ $item->image_cover }}" class="card-img-top" alt="image">
                                    </div>
                                </a>
                                <div class="card-body">
                                    <a href="{{ url('/jual-' . $item->category_slug . '/' . $item->slug) }}"
                                        class="text-decoration-none text-muted">
                                        <h5 class="font-weight-normal">{{ $item->title }}</h5>
                                    </a>
                                    <h4 class="fw-bold"> Rp. {{ number_format($item->price) }} </h4>
                                    <h5 class="fw-bold"> <i class="ti ti-map-pin"></i> {{ $item->city_name }} </h5>

                                </div>
                                <div class="card-footer bg-white">
                                    <div class="row">
                                        <div class="col-4">
                                            <small> <i class="ti ti-manual-gearbox"></i> {{ $item->transmision }}</small>
                                        </div>
                                        <div class="col-4 border-start">
                                            <small> <i class="ti ti-gas-station"></i> {{ $item->fuel }} </small>
                                        </div>
                                        <div class="col-4 border-start">
                                            <small> <i class="ti ti-calendar-time"></i> {{ $item->year }} </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                </div>

                <div class="card mb-3">
                    <div class="card-body">


                    </div>
                    @endforelse

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
    @endsection
