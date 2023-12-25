@extends('layouts.admin')

@section('title', 'PM. Jaya Perkasa - Admin Dashboard')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 fs-2">Dashboard</h1>
        <ol class="breadcrumb mb-5">
            <li class="breadcrumb-item active">Dashboard Page</li>
        </ol>
        <div class="card">
            <div class="card-header bg-info">
                <h5 class="my-3">Welcome, Admin</h5>
            </div>
            <div class="card-body py-4">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="card">
                            <div class="card-header bg-warning">
                                <h6 class="my-2">Product Data</h6>
                            </div>
                            <div class="card-body">
                                <p class="fs-2 fw-bold my-0">{{ $data['product_count'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card">
                            <div class="card-header bg-warning">
                                <h6 class="my-2">Customer Data</h6>
                            </div>
                            <div class="card-body">
                                <p class="fs-2 fw-bold my-0">{{ $data['customer_count'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card">
                            <div class="card-header bg-warning">
                                <h6 class="my-2">Payment Data (Pending)</h6>
                            </div>
                            <div class="card-body">
                                <p class="fs-2 fw-bold my-0">{{ $data['payment_count'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection