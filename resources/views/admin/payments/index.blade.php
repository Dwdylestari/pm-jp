@extends('layouts.admin')

@section('title', 'PM. Jaya Perkasa - Admin Payments')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 fs-2">Payments</h1>
        <ol class="breadcrumb mb-5">
            <li class="breadcrumb-item active">Payments Page</li>
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
                    <p class="fs-6 my-0">Payments Table</p>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Payment Date</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Payment Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['transaction'] as $transaction)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transaction->transaction_payment->updated_at }}</td>
                                    <td>{{ $transaction->user->user_name }}</td>
                                    <td>Rp. {{ $transaction->transaction_totalprice }}</td>
                                    <td>{{ $transaction->transaction_payment->transaction_payment_status }}</td>
                                    <td>
                                        <form action="{{ route('admin.payment.update', ['transaction_payment_uuid' => $transaction->transaction_payment->transaction_payment_uuid]) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-primary">Confirm Payment</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection