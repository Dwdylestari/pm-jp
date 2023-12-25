@extends('layouts.landingPage')

@section('title', 'PM. Jaya Perkasa - Login')

@section('navbar')
    @include('components/generalNavbar')
@endsection

@section('content')
    <div class="container">
        <div class="row my-5 justify-content-center">
            <div class="col-12 col-lg-5 my-lg-5">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h1 class="fs-5 my-2 text-center">PM. Jaya Perkasa - Login</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.login') }}" method="POST">
                            @csrf
                            <div class="d-flex flex-column gap-4">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="dewilestari@gmail.com" required>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="password123" required>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success">Masuk</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection