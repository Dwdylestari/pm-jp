@extends('layouts.admin')

@section('title', 'PM. Jaya Perkasa - Admin Customers')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 fs-2">Customers</h1>
        <ol class="breadcrumb mb-5">
            <li class="breadcrumb-item active">Customers Page</li>
        </ol>
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <p class="fs-6 my-0">Customers Table</p>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['customers'] as $customer)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $customer->user_name }}</td>
                                    <td>{{ $customer->user_username }}</td>
                                    <td>{{ $customer->user_email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection