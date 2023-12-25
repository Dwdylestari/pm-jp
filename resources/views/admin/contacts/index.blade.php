@extends('layouts.admin')

@section('title', 'PM. Jaya Perkasa - Admin Contacts')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 fs-2">Admin Contacts</h1>
        <ol class="breadcrumb mb-5">
            <li class="breadcrumb-item active">Admin Contacts Page</li>
        </ol>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <p class="fs-6 my-0">Admin Contacts Table</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa-solid fa-plus"></i>
                        Add Contacts
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Admin Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['admins'] as $admin)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $admin->user_name }}</td>
                                    <td>{{ $admin->user_email }}</td>
                                    <td>{{ $admin->user_phonenumber }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Admin Contact Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.contact.store') }}" method="POST">
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
                                <input type="number" class="form-control" name="user_phoneNumber" id="phone" placeholder="88131021878" value="{{ old('user_phoneNumber') }}">
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
@endsection