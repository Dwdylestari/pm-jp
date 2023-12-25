@extends('layouts.customer')

@section('title', 'PM. Jaya Perkasa - Customer Dashboard')

@section('content')
    <div class="container-fluid px-4 my-5">
        <div class="my-5 d-flex flex-column align-items-center gap-3">
            <h1 class="fs-4">Enter Your Address</h1>
        </div>
        <div class="my-4">
            <form action="{{ route('customer.address.store', ['transaction_uuid' => session('transaction_uuid')]) }}" method="POST">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="my-2 text-center fs-6">Input Address Form</h2>
                            </div>
                            <div class="card-body">
                                <div class="row gy-4">
                                    {{-- <input type="hidden" value="{{ $data['transaction']->transaction_uuid }}" name="transaction_delivery_transaction_uuid"> --}}
                                    <input type="hidden" value="{{ $data['transaction_weight'] }}" id="transaction_weight" name="transaction_delivery_weight">
                                    <input type="hidden" id="transaction_shippingcost" name="transaction_delivery_shippingcost">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="transcation_delivery_province" class="form-label">Provice</label>
                                            <input type="hidden" name="province_id" value="{{ $data['province']['province_id'] }}">
                                            <input type="text" name="transaction_delivery_province" id="transcation_delivery_province" class="form-control" value="{{ $data['province']['province'] }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="transaction_delivery_city" class="form-label">City</label>
                                            <select name="transaction_delivery_city" id="transcation_delivery_city" class="form-control">
                                                <option>- Choose a City -</option>
                                                @foreach ($data['cities'] as $city)
                                                    <option value="{{ $city['type'] . $city['city_name'] }}" data-city="{{ $city['city_id'] }}">{{ $city['type'] }}  {{ $city['city_name'] }}</option>
                                                @endforeach
                                            </select>                                            
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="transaction_delivery_address" class="form-label">Address Details</label>
                                            <input type="text" class="form-control" name="transaction_delivery_address" id="transaction_delivery_address" placeholder="Enter your address details">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="transaction_delivery_service" class="form-label">Delivery</label>
                                            <select name="transaction_delivery_service" id="transaction_delivery_service" class="form-control">
                                                <option>- Choose a Delivery Service -</option>
                                                <option value="From Store" data-service="jne">From Store</option>
                                                <option value="JNE" data-service="pos">POS Indonesia</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex align-items-center justify-content-between">
                                    <p class="my-2">
                                        <strong>Shipping Cost:</strong>
                                        <span id="shippingCost">Rp. -</span>
                                    </p>
                                    <button class="btn btn-primary">Continue Paying</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#transcation_delivery_city, #transaction_delivery_service').change(function() {
            var cityId = $('#transcation_delivery_city').find(':selected').data('city');
            var service = $('#transaction_delivery_service').find(':selected').data('service');
            var weight = $('#transaction_weight').val()
            if (cityId && service) {
                $.ajax({
                    url: '/customer/address/checkongkir',
                    type: 'POST',
                    data: {
                        origin: '113',
                        destination: cityId,
                        weight: weight,
                        courier: service,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        $('#shippingCost').text('Rp. ' + response.rajaongkir.results[0].costs[1].cost[0].value)
                        $('#transaction_shippingcost').val(response.rajaongkir.results[0].costs[1].cost[0].value);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
        });
    });
</script>
@endpush