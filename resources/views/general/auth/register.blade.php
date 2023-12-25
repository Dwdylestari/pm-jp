@extends('layouts.landingPage')

@section('title', 'PM. Jaya Perkasa - Register')

@section('navbar')
    @include('components/generalNavbar')
@endsection

@section('content')
    <div class="container">
        <div class="row my-5 justify-content-center">
            <div class="col-12 col-lg-5">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h1 class="fs-5 my-2 text-center">PM. Jaya Perkasa - Register</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.register') }}" method="POST">
                            @csrf
                            <div class="d-flex flex-column gap-4">
                                <div class="form-group">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="user_name" id="name" placeholder="Dewi Lestari" value="{{ old('user_name') }}">
                                    @if ($errors->has('user_name'))                                        
                                        @foreach ($errors->get('user_name') as $error)
                                            <div class="text-danger mt-1">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" name="user_username" id="username" placeholder="Dewilestari" value="{{ old('user_username') }}">
                                    @if ($errors->has('user_username'))                                        
                                        @foreach ($errors->get('user_username') as $error)
                                            <div class="text-danger mt-1">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="number" class="form-control" name="user_phonenumber" id="phone" placeholder="88131021878" value="{{ old('user_phoneNumber') }}">
                                    @if ($errors->has('user_phoneNumber'))                                        
                                        @foreach ($errors->get('user_phoneNumber') as $error)
                                            <div class="text-danger mt-1">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="user_email" id="email" placeholder="dewilestari@gmail.com" value="{{ old('user_email') }}">
                                    @if ($errors->has('user_email'))                                        
                                        @foreach ($errors->get('user_email') as $error)
                                            <div class="text-danger mt-1">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="user_password" id="password" placeholder="password123">
                                    @if ($errors->has('user_password'))                                        
                                        @foreach ($errors->get('user_password') as $error)
                                            <div class="text-danger mt-1">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection