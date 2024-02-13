@extends('layouts.app')
@section('content')
    @include('layouts.inc.frontend.header')
    <div class="container my-3 mb-5">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('activated'))
                <div class="alert alert-success" role="alert">
                    {{ session('activated') }}
                </div>
            @endif
            <!-- /User Card -->
            <div class="col-md-8 mx-auto">
                <div class="alert alert-success">
                    <h3> Selamat Datang <b>{{ Auth::user()->name }}</b></h3>
                    <p>ini Adalah halaman akun anda, anda dapat mengatur profile serta foto anda di sini</p>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="d-grid gap-2">
                            @if (Auth::user()->role_as == 3)
                                <a href="{{ url('seller/create') }}" class="btn btn-success btn-lg"> <i
                                        class='ti ti-pencil'></i> Pasang Iklan</a>

                                <div class="row my-3">
                                    <div class="col-md-4">
                                        <div class="card card-stats mb-4 mb-xl-0">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="card-title text-muted mb-0">Iklan Saya
                                                        </h5>
                                                        <span class="h2 font-weight-bold mb-0">{{ count($myads) }}</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div
                                                            class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                            <i class="ti ti-flask"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="mt-3 mb-0 text-muted text-sm">
                                                    <span class="text-nowrap"><a class="text-muted text-decoration-none"
                                                            href="{{ url('seller/dashboard') }}">
                                                            Lihat Semua Iklan<i class="ti ti-arrow-right"></i> </a></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="card card-stats mb-4 mb-xl-0">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="card-title text-muted mb-0">Paket Iklan Saya
                                                        </h5>
                                                        <span
                                                            class="h2 font-weight-bold mb-0">{{ count($mypackage) }}</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div
                                                            class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                                            <i class="ti ti-box"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="mt-3 mb-0 text-muted text-sm">
                                                    <span class="text-nowrap"><a class="text-muted text-decoration-none"
                                                            href="{{ url('seller/dashboard') }}">
                                                            Lihat Semua Iklan<i class="ti ti-arrow-right"></i> </a></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            @else
                                <a href="{{ url('member/seller') }}" class="btn btn-primary btn-lg"> <i
                                        class='bx bx-shopping-bag'></i> Daftar Jadi Penjual</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4 col-12">
                <div class="card">
                    <div class="card-header">
                        Ubah Password
                    </div>
                    <div class="card-body">
                        <form action="{{ url('member/update_password') }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group mb-2">
                                <label for="password" class="col-form-label text-md-end">{{ __('Ubah Password') }}</label>

                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="row mb-0">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class='bx bx-lock'></i> Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Dependence Dropdown for Applicant
        $('#country-dropdown').on('change', function() {
            var idProvince = this.value;
            $("#state-dropdown").html('');
            $.ajax({
                url: "{{ url('member/fetch-city') }}",
                type: "POST",
                data: {
                    province_id: idProvince,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#state-dropdown').html('<option value="">-- Pilih Kota --</option>');
                    $.each(result.cities, function(key, value) {
                        $("#state-dropdown").append('<option value="' + value.id + '">' + value
                            .name + '</option>');
                    });
                }
            });
        });




        // Select2
        $('.single-select-field').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });

        // Datepicker
        $(function() {
            $('#datepicker').datepicker({
                format: 'yyyy-dd-mm',
            });
        });
    </script>
@endsection
