@extends('layouts.app')

@section('content')
    @include('layouts.inc.frontend.header')

    <div class="container">

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="mx-auto">
            <div class="row">


                @foreach ($packages as $package)
                    <div class="col-sm-6 col-xl-3 mb-3">
                        <div class="card @if ($package->highlight == 1) bg-success @endif border">
                            <div
                                class="card-header border-bottom flex-column align-items-start p-3 @if ($package->highlight == 1) text-white @endif">
                                <i
                                    class=" {!! $package->icon !!} text-success @if ($package->highlight == 1) text-white @endif h3"></i>
                                <h4
                                    class="text-success font-weight-light mb-2 @if ($package->highlight == 1) text-white @endif">
                                    {{ $package->name }}</h4>
                                <p class="font-size-sm mb-0">{{ $package->description_period }}</p>
                            </div>
                            <div class="card-header border-bottom justify-content-center py-4">
                                <h2 class="pricing-price @if ($package->highlight == 1) text-white fw-bold @endif">
                                    <small class="align-self-start">Rp</small>
                                    {{ number_format($package->price) }}
                                    <small class="align-self-end"></small>
                                </h2>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled font-size-sm mb-0">
                                    <li>
                                        <div><i
                                                class="bx bx-check text-success @if ($package->highlight == 1) text-white @endif h3"></i>
                                            <strong class="@if ($package->highlight == 1) text-white @endif">
                                                @if ($package->count > 900000)
                                                    {{ 'Unlimited' }}
                                                @else
                                                    {{ $package->count }}
                                                @endif
                                            </strong><span
                                                class="text-secondary ml-1 @if ($package->highlight == 1) text-white @endif">Iklan</span>
                                        </div>

                                        <small
                                            class="@if ($package->highlight == 1) text-white @endif">{{ $package->description_ads }}</small>
                                    </li>

                                </ul>
                            </div>
                            <div
                                class="card-footer justify-content-center p-3 @if ($package->highlight == 1) border-white @endif">
                                <div class="d-grid gap-2">
                                    <form action="{{ url('seller/packages/order') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="package_id" value="{{ $package->id }}">
                                        <input type="hidden" name="count" value="{{ $package->count }}">
                                        <input type="hidden" name="price" value="{{ $package->price }}">
                                        <div class="d-grid gap-2">
                                            <button
                                                class="btn btn-outline-success @if ($package->highlight == 1) btn-outline-warning fw-bold @endif">BELI
                                                PAKET</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
