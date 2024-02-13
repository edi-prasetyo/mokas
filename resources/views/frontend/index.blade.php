@extends('layouts.app')
@section('title', 'Atrans Auto')
@section('content')




    <section class="my-5 pt-5 bg-dark"
        style="background:linear-gradient(to right, rgba(0,0,0, 0.9), rgba(0, 0, 0, 0.3)), url({{ asset('uploads/slider/bg-home.jpg') }}); background-size: cover; min-height: 60vh;">
        <div class="hero-img pt-5">
            <div class="container px-4 px-lg-0 ">
                <!-- Hero Section -->
                <div class="row align-items-center">
                    <div class=" col-md-7 mt-5">
                        <div class="mb-4 text-center text-xl-start px-md-8 px-lg-19 px-xl-0">
                            <!-- Caption -->
                            <h1 class="display-3 fw-bold mb-3 ls-sm text-white">
                                <span class="text-primary">Jual Beli</span>, Mobil dan Motor Bekas
                            </h1>
                            <p class="mb-6 lead pe-lg-6 text-white">
                                Punya Mobil atau motor jual disini aja
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end">
                        <div class="">


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section>

        <div class="container form-search card border-0 shadow d-flex justify-content-center">
            <!-- nav options -->
            <div class="">
                <ul class="nav nav-pills mb-3 border-bottom" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#pills-home"
                            role="tab" aria-controls="pills-home" aria-selected="true"><i class="ti ti-car me-3"></i>
                            Mobil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#pills-profile"
                            role="tab" aria-controls="pills-profile" aria-selected="false"><i
                                class="ti ti-motorbike me-3"></i> Motor</a>
                    </li>

                </ul>
            </div>


            <!-- content -->
            <div class="tab-content" id="pills-tabContent p-3">
                <!-- 1st card -->
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <input type="text" class="form-control" name="" placeholder="keyword">
                        </div>
                        <div class="col-md-3 mb-2">
                            <select class="form-select single-select-field" aria-label="Default select example">
                                <option selected>Pilih Merek</option>
                                @foreach ($car_brand as $car_brand)
                                    <option value="{{ $car_brand->id }}">{{ $car_brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <select class="form-select single-select-field" aria-label="Default select example">
                                <option selected>Pilih Kota</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg"> <i class='bx bx-search-alt-2'></i>
                                    Cari</button>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- 2nd card -->
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <input type="text" class="form-control" name="" placeholder="keyword">
                        </div>
                        <div class="col-md-3 mb-2">
                            <select class="form-select single-select-field" aria-label="Default select example">
                                <option selected>Pilih Merek</option>
                                @foreach ($motor_brand as $motor_brand)
                                    <option value="{{ $motor_brand->id }}">{{ $motor_brand->name }}</option>
                                @endforeach
                            </select>
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <select class="form-select single-select-field" aria-label="Default select example">
                                <option selected>Pilih Kota</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg"> <i class='bx bx-search-alt-2'></i>
                                    Cari</button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <section class="pt-5 pb-5">
        <div class="container">
            <div class="row mb-md-2">
                @foreach ($cars as $car)
                    <div class="col-md-3">
                        <div class="card shadow-sm  mb-4">
                            <a href="{{ url('/jual-' . $car->category_slug . '/' . $car->slug) }}"
                                class="position-relative">
                                <div class="card-image-cover">
                                    <img src="{{ $car->image_cover }}" class="card-img-top" alt="image">
                                </div>
                            </a>
                            <div class="card-body">
                                <a href="{{ url('/jual-' . $car->category_slug . '/' . $car->slug) }}"
                                    class="text-decoration-none text-muted">
                                    <h5 class="font-weight-normal">{{ $car->title }}</h5>
                                </a>
                                <h4 class="fw-bold"> Rp. {{ number_format($car->price) }} </h4>
                                <h6 class=""> <i class="ti ti-map-pin"></i> {{ $car->city_name }} </h6>

                            </div>
                            <div class="card-footer bg-white">
                                <div class="row">
                                    <div class="col-4">
                                        <small> <i class="ti ti-manual-gearbox"></i> {{ $car->transmision }}</small>
                                    </div>
                                    <div class="col-4 border-start">
                                        <small> <i class="ti ti-gas-station"></i> {{ $car->fuel }} </small>
                                    </div>
                                    <div class="col-4 border-start">
                                        <small> <i class="ti ti-calendar-time"></i> {{ $car->year }} </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- FEATURES -->
    <section class="py-5 my-5">
        <div class="container">
            <div class="text-center">
                <h1 class="display-5 fw-bold mb-3 ls-sm ">
                    <span class="text-primary">Layanan</span> Atrans Auto
                </h1>
                <p class="lead mb-5">
                    Jual Beli Mobil dan Motor denga Mudah
                </p>
            </div>
            <div class="row">
                <div class="col-12 col-md-4" data-aos="fade-up">
                    <div class="card shadow border-0 mb-3">
                        <div class="card-body">
                            <!-- Icon -->
                            <div
                                class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3 p-3 rounded">
                                <i class='bx bx-code-alt'></i>
                            </div>


                            <!-- Heading -->
                            <h4>
                                Jual Mobil
                            </h4>

                            <!-- Text -->
                            <p class="text-muted mb-6 mb-md-0">
                                Jual Beli mobil berkualitas
                            </p>
                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-4" data-aos="fade-up" data-aos-delay="50">
                    <div class="card shadow border-0 mb-3">
                        <div class="card-body">
                            <!-- Icon -->
                            <div
                                class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3 p-3 rounded">
                                <i class='bx bx-video-recording'></i>
                            </div>

                            <!-- Heading -->
                            <h4>
                                Jual Motor
                            </h4>

                            <!-- Text -->
                            <p class="text-muted mb-6 mb-md-0">
                                Jual Beli motor Berkualitas.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card shadow border-0 mb-3">
                        <div class="card-body">
                            <!-- Icon -->
                            <div
                                class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3 p-3 rounded">
                                <i class='bx bx-receipt'></i>
                            </div>

                            <!-- Heading -->
                            <h4>
                                Pasang Iklan
                            </h4>

                            <!-- Text -->
                            <p class="text-muted mb-0">
                                Pasang iklan jual beli mobil dan motor anda.
                            </p>
                        </div>
                    </div>

                </div>
            </div> <!-- / .row -->
            <div class="text-center mt-5">
                <a href="https://wa.me/6281233335523" class="btn btn-success btn-lg px-3"><i class='bx bxl-whatsapp'></i>
                    Hubungi Kami</a>
            </div>
        </div>
        <!-- / .container -->
    </section>

@endsection

@section('scripts')
    <script>
        $('.single-select-field').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
    </script>
@endsection
