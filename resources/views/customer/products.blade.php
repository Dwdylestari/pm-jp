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
        <div class="d-flex flex-column gap-5">
            <form action="#" method="GET" class="w-25">
                @csrf
                <input type="text" class="form-control" placeholder="Search product...." name="search" id="search" autocomplete="off">
            </form>
            <div class="d-flex flex-column gap-4">
                <h1 class="fs-4 text-center">Plafon PVC Boards</h1>
                <div class="row justify-content-center mt-4" id="results">
                    @foreach ($data['boards'] as $board)
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="card">
                                <img src="{{ asset('images/products/' . $board->product_img) }}" class="card-img-top" alt="Product Image">
                                <div class="card-body">
                                    <p class="my-2 card-text"><strong>Product Name</strong>: {{ $board->product_name }}</p>
                                    <p class="my-2 card-text"><strong>Product Weight</strong>: {{ $board->product_weight }} kg</p>
                                    <p class="my-2 card-text"><strong>Product Price</strong>: Rp {{ $board->product_price }}</p>
                                    @php
                                        $isInCart = $data['transaction_details'] != null ? $data['transaction_details']->contains('transaction_detail_product_uuid', $board->product_uuid) : false;
                                    @endphp

                                    @if ($isInCart)
                                        <p class="my-2 text-secondary">Product is exist in cart!</p>
                                    @else
                                        <form action="{{ route('customer.product.store', ['product_uuid' => $board->product_uuid]) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-warning mt-4" type="submit">
                                                <i class="fa-solid fa-cart-shopping"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="d-flex flex-column gap-4">
                <h1 class="fs-4 text-center">Plafon PVC Equipments</h1>
                <div class="row justify-content-center mt-4">
                    @foreach ($data['equipments'] as $equipment)
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="card">
                                <img src="{{ asset('images/products/' . $equipment->product_img) }}" class="card-img-top" alt="Product Image">
                                <div class="card-body">
                                    <p class="my-2 card-text"><strong>Product Name</strong>: {{ $equipment->product_name }}</p>
                                    <p class="my-2 card-text"><strong>Product Weight</strong>: {{ $equipment->product_weight }} kg</p>
                                    <p class="my-2 card-text"><strong>Product Price</strong>: Rp {{ $equipment->product_price }}</p>
                                    @php
                                        $isInCart = $data['transaction_details'] != null ? $data['transaction_details']->contains('transaction_detail_product_uuid', $equipment->product_uuid) : false;
                                    @endphp

                                    @if ($isInCart)
                                        <p class="my-2 text-secondary">Product is exist in cart!</p>
                                    @else
                                        <form action="{{ route('customer.product.store', ['product_uuid' => $equipment->product_uuid]) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-warning mt-4" type="submit">
                                                <i class="fa-solid fa-cart-shopping"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        var originalContent = $('#results').html();

        $('#search').on('keyup', function() {
            $value = $(this).val();

            if ($value === '') {
                $('#results').html(originalContent);
            } else {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('customer.product.search') }}',
                    data: {
                        'search': $value
                    },
                    success: function(data) {
                        $('#results').html(data);
                    }
                });
            }
        });
    </script>
@endpush