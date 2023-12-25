@extends('layouts.customer')

@section('title', 'PM. Jaya Perkasa - Customer Dashboard')

@section('content')
    <div class="container-fluid px-4 my-5">
        <div class="my-5 d-flex flex-column align-items-center gap-3">
            <h1 class="fs-4">Detail Payment</h1>
        </div>
        <div class="row justify-content-center my-4">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <p><strong>Name : </strong> {{ $data['detail_payment']->user->user_name }}</p>
                        <p><strong>Shipping Address : </strong> {{ $data['detail_payment']->transaction_delivery->transaction_delivery_address }}, {{ $data['detail_payment']->transaction_delivery->transaction_delivery_city }}, {{ $data['detail_payment']->transaction_delivery->transaction_delivery_province }}</p>
                        <p><strong>Total Product Price : </strong>Rp. {{ $data['detail_payment']->transaction_totalprice }}</p>
                        <p><strong>Shipping Cost : </strong>Rp. {{ $data['detail_payment']->transaction_delivery->transaction_delivery_shippingcost }}</p>
                        <p><strong>Total Price : </strong> Rp. {{ $data['detail_payment']->transaction_totalprice +  $data['detail_payment']->transaction_delivery->transaction_delivery_shippingcost}}</p>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bankModal">Choose a Bank</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="bankModal" tabindex="-1" aria-labelledby="bankModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Choose a Bank</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('customer.detail_payment.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="" class="form-label">Bank</label>
                        <select name="transaction_payment_payment_method_uuid" id="transaction_payment_payment_method_uuid" class="form-control">
                            <option value="">- Choose a Bank -</option>
                            @foreach ($data['banks'] as $bank)
                                <option value="{{ $bank->paymentmethod_uuid }}">{{ $bank->bank->bank_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">Continue Paying</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
@endsection