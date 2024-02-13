@extends('layouts.app')
@section('title', 'Mobil Dijual')
@section('content')
    @include('layouts.inc.frontend.header')
    <div class="container my-5">
        <div class="row">

            <div class="col-md-9">

                @forelse($cars as $item)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{ $item->image_cover }}">
                                </div>
                                <div class="col-md-5">
                                    <h2>{{ $item->title }}</h2>
                                    <i class="ti ti-manual-gearbox"></i> {{ $item->transmision }}
                                    <i class="ti ti-gas-station"></i> {{ $item->fuel }}
                                    <i class="ti ti-engine"></i> {{ $item->engine_capacity }} CC
                                    <i class="ti ti-dashboard"></i> {{ $item->odometer }}
                                    <i class="ti ti-calendar-time"></i> {{ $item->year }}

                                </div>
                                <div class="col-md-4 border-start">
                                    <h3 class="fw-bold"> Rp. {{ number_format($item->price) }} </h3>
                                    <div class="d-grid gap-2">
                                        <a href="{{ url('/') }}" class="btn btn-primary btn-sm">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty

                    <div class="card mb-3">
                        <div class="card-body">


                        </div>
                @endforelse










                <div class="d-flex justify-content-center row">
                    <div class="row bg-white border rounded">
                        <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image"
                                src="https://i.imgur.com/QpjAiHq.jpg"></div>
                        <div class="col-md-6 mt-1">
                            <h5>Quant olap shirts</h5>
                            <div class="d-flex flex-row">
                                <div class="ratings mr-2"><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                        class="fa fa-star"></i><i class="fa fa-star"></i></div><span>310</span>
                            </div>
                            <div class="mt-1 mb-1 spec-1"><span>100% cotton</span><span class="dot"></span><span>Light
                                    weight</span><span class="dot"></span><span>Best finish<br></span></div>
                            <div class="mt-1 mb-1 spec-1"><span>Unique design</span><span class="dot"></span><span>For
                                    men</span><span class="dot"></span><span>Casual<br></span></div>
                            <p class="text-justify text-truncate para mb-0">There are many variations of passages of
                                Lorem Ipsum available, but the majority have suffered alteration in some form, by
                                injected humour, or randomised words which don't look even slightly believable.<br><br>
                            </p>
                        </div>
                        <div class="align-items-center align-content-center col-md-3 border-start mt-1">
                            <div class="d-flex flex-row align-items-center">
                                <h4 class="mr-1">$13.99</h4><span class="strike-text">$20.99</span>
                            </div>
                            <h6 class="text-success">Free shipping</h6>
                            <div class="d-flex flex-column mt-4"><button class="btn btn-primary btn-sm"
                                    type="button">Details</button><button class="btn btn-outline-primary btn-sm mt-2"
                                    type="button">Add to wishlist</button></div>
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
