@extends('layouts.customer')

@section('title', 'PM. Jaya Perkasa - Customer Contacts')

@section('content')
    <div class="container-fluid px-4 my-5">
        <div class="card">
            <div class="card-header">
                <p class="my-2">Admin Contacts Table</p>
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
@endsection