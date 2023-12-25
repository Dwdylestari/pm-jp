@extends('layouts.landingPage')

@section('title', 'PM. Jaya Perkasa')

@section('navbar')
    @include('components/generalNavbar')
@endsection

@section('content')
    <div class="container">
        <div class="row my-5 gx-0 gx-lg-5 align-items-center">
            <div class="col-12 col-lg-6 my-md-5">
                <div class="d-flex flex-column gap-2">
                    <h1 class="font-bolder fs-2">Menjual Plafon PVC</h1>
                    <p class="text-secondary w-75">Perbaiki atap rumah anda dengan pilihan plafon PVC dengan mutu terbaik</p>
                    <a href="{{ route('general.auth.login') }}" class="btn btn-primary mt-3" style="width: fit-content; padding: 10px 24px;">Login</a>
                </div>
            </div>
            <div class="col-12 col-lg-6 my-5">
                <img src="{{ asset('images/plafonpvc.jpeg') }}" alt="Plafon Image" class="img-fluid rounded">
            </div>
        </div>
    </div>
@endsection