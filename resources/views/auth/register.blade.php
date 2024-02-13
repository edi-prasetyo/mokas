@extends('layouts.app')
@include('layouts.inc.frontend.header')
@section('content')
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0">


                <div class="card-body px-5">
                    @if ($errors->any())
                    <div class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                        @endforeach
                    </div>
                    @endif

                    <h4>{{ __('Register') }}</h4>


                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group mb-2">
                            <label for="name" class="col-form-label">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="form-group mb-2">
                            <label for="email" class="col-form-label">{{ __('Email Address')
                                }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="form-group mb-2">
                            <label for="email" class="col-form-label">{{ __('Whatsapp')
                                }}</label>
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="form-group mb-2">
                            <label for="password" class="col-form-label text-md-end">{{ __('Password')
                                }}</label>

                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="form-group mb-2">
                            <label for="password-confirm" class="col-form-label text-md-end">{{ __('Confirm
                                Password') }}</label>

                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="row mb-0">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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