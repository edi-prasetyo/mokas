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
            <div class="card">
                <div class="card-header">
                    Lengkapi Data Anda
                </div>
                <div class="card-body">

                 

                    @if ($errors->any())
                    <div class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                        @endforeach
                    </div>
                    @endif

                    <form action="{{url('member/add-seller')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <input type="hidden" name="post_ads" value="1">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Logo Penjual
                                    </label>
                                    <input type="file" name="photo" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Nama Toko</label>
                                    <input type="text" class="form-control @error('showroom_name') is-invalid @enderror"
                                        name="showroom_name" value="{{ old('seller_name') }}">
                                    @error('showroom_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Nomor KTP Penjual</label>
                                    <input type="text" class="form-control @error('card_id') is-invalid @enderror"
                                        name="card_id" value="{{ old('card_id') }}">
                                    @error('card_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            

                          

                            <div class="col-md-6 ">
                                <div class="form-group mb-3">
                                    <label class="form-label">Pilih Provinsi</label>
                                    <select
                                        class="form-select single-select-field @error('province') is-invalid @enderror"
                                        id="country-dropdown" data-placeholder="Pilih Provinsi" name="province_id">
                                        <option value=""></option>
                                        @foreach($provinces as $key => $province)
                                        <option value="{{$province->id}}" {{ old('province_id')==$province->id ?
                                            "
                                            selected" :""}}>{{$province->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('province')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Kota</label>
                                    <select id="state-dropdown"
                                        class="form-select single-select-field @error('city_id') is-invalid @enderror"
                                        name="city_id">
                                    </select>
                                    @error('city_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea name="address"
                                        class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>




        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Ubah Password
                </div>
                <div class="card-body">
                    <form action="{{url('member/update_password')}}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group mb-2">
                            <label for="password" class="col-form-label text-md-end">{{ __('Ubah Password')
                                }}</label>

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
    $('#country-dropdown').on('change', function () {
    var idProvince = this.value;
    $("#state-dropdown").html('');
    $.ajax({
        url: "{{url('member/fetch-city')}}",
        type: "POST",
        data: {
            province_id: idProvince,
            _token: '{{csrf_token()}}'
        },
        dataType: 'json',
        success: function (result) {
            $('#state-dropdown').html('<option value="">-- Pilih Kota --</option>');
            $.each(result.cities, function (key, value) {
                $("#state-dropdown").append('<option value="' + value.id + '">' + value.name + '</option>');
            });
        }
    });
});


// Select2
$( '.single-select-field' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
} );

// Datepicker
$(function(){
  $('#datepicker').datepicker({
    format: 'yyyy-dd-mm',
  });
});
</script>
@endsection