@extends('layouts.customer')

@section('title', 'PM. Jaya Perkasa - Customer Dashboard')

@section('content')
    <div class="container-fluid px-4 my-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <p class="my-2">Product Data in Your Cart</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Weight</th>
                                <th scope="col">Product Price</th>
                                <th scope="col">Product Quantity</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data['carts'] as $cart)
                                <tr id="cartRow_{{ $cart->user_transaction_detail_uuid }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $cart->product_name }}</td>
                                    <td>{{ $cart->product_weight }} kg</td>
                                    <td>{{ $cart->product_price }}</td>
                                    <td class="d-flex align-items-center gap-4">
                                        <button class="btn btn-warning decrementBtn" data-action="decrement" data-cart-uuid="{{ $cart->transaction_detail_uuid }}">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <span id="cartQuantity_{{ $cart->transaction_detail_uuid }}">{{ $cart->transaction_detail_quantity }}</span>
                                        <button class="btn btn-warning incrementBtn" data-action="increment" data-cart-uuid="{{ $cart->transaction_detail_uuid }}">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </td>
                                    <td id="cartTotalPrice_{{ $cart->transaction_detail_uuid }}">{{ $cart->transaction_detail_totalprice }}</td>
                                    <td>
                                        <form action="{{ route('customer.cart.delete', ['cart_uuid' => $cart->transaction_detail_uuid]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Empty!</strong> Your cart is empty.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex flex-column align-items-end gap-4 mt-4">
                        <p class="my-0">
                            <strong>Cart Total Price: </strong>
                            <span id="cartTotalPrice" >
                                Rp.{{ isset($data['transaction']) && $data['transaction']->transaction_totalprice != null ? $data['transaction']->transaction_totalprice : '' }}
                            </span>
                        </p>
                        {!! isset($data['transaction']->transaction_uuid) && $data['transaction']->transaction_uuid != null ? '<a href="'. route('customer.address', ['transaction_uuid' => $data['transaction']->transaction_uuid]) .'" class="btn btn-primary">Continue Paying</a>' : '' !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.incrementBtn, .decrementBtn').click(function () {
                var action = $(this).data('action');
                var cartUuid = $(this).data('cart-uuid');

                $.ajax({
                    type: 'PATCH',
                    url: '/customer/cart/' + cartUuid + '/count?action=' + action,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#cartQuantity_' + cartUuid).text(response.cart.transaction_detail_quantity);
                        $('#cartTotalPrice_' + cartUuid).text(response.cart.transaction_detail_totalprice);
                        $('#cartTotalPrice').text('Rp.' + response.transaction.transaction_totalprice);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endpush