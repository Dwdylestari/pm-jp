@extends('layouts.customer')

@section('title', 'PM. Jaya Perkasa - Customer Dashboard')

@section('content')
    <div class="container-fluid px-4 my-5">
        <div class="row justify-content-center my-4">
            <div class="col-12 col-md-6 col-lg-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <p class="my-2 text-center fw-bolder">Payment</p>
                    </div>
                    <div class="card-body">
                        @if (isset($data['transaction_payment'], $data['paymentmethod']) && $data['transaction_payment'] != null && $data['paymentmethod'] != null)
                            <p class="mb-4"><strong>Virtual Account Number : </strong>{{ $data['paymentmethod']->paymentmethod_accountnumber }}</p>
                            <p class="my-4"><strong>Bank : </strong>{{ $data['paymentmethod']->bank->bank_name }}</p>
                            <p class="my-4"><strong>Payment Status : </strong>{{ $data['transaction']->transaction_payment->transaction_payment_status }}</p>
                            <p class="my-4"><strong>Total Payment : </strong>{{ $data['transaction']->transaction_payment->transaction_payment_status == 'Unpaid' ? $data['transaction']->transaction_totalprice + $data['transaction']->transaction_delivery->transaction_delivery_shippingcost : $data['transaction']->transaction_totalprice }}</p>
                            <hr class="my-4">
                            {!! $data['transaction']->transaction_payment->transaction_payment_status == 'Unpaid' ? '<form action="'. route('customer.payment.update', ['transaction_payment_uuid' => $data['transaction']->transaction_payment->transaction_payment_uuid]) .'" method="POST">
                                '. csrf_field() .'
                                '. method_field('PATCH') .'
                                <button type="submit" class="btn btn-primary">Confirm Payments</button>
                            </form>' : ($data['transaction']->transaction_payment->transaction_payment_status == 'Pending' ? '<button class="btn btn-warning" disabled>Waiting for Admin Confirmed</button>' : '<button class="btn btn-success" disabled>Payment Confirmed</button>') !!}
                        @else
                            <p class="text-center my-2 text-danger">No payments to be made</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection