<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\TransactionDeliveryModel;
use App\Models\TransactionDetailModel;
use App\Models\TransactionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AddressController extends Controller
{
    public function index(string $transaction_uuid)
    {
        $response_cities = Http::get('https://api.rajaongkir.com/starter/city', [
            'key' => 'ecefea7e4a9a75ca38e6246566b02588'
        ]); // API untuk get data kota

        $response_provinces = Http::get('https://api.rajaongkir.com/starter/province', [
            'key' => 'ecefea7e4a9a75ca38e6246566b02588',
            'id' => "10"
        ]); // API untuk get data provinsi

       // dd($response_cities);
    

        $allCities = $response_cities['rajaongkir']['results'];

        $desiredCities = [
            ['name' => 'KUDUS', 'type' => 'Kabupaten'],
            ['name' => 'PATI', 'type' => 'Kabupaten'],
            ['name' => 'JEPARA', 'type' => 'Kabupaten'],
            ['name' => 'DEMAK', 'type' => 'Kabupaten'],
            ['name' => 'KUDUS', 'type' => 'Kota'],
            ['name' => 'PATI', 'type' => 'Kota'],
            ['name' => 'JEPARA', 'type' => 'Kota'],
            ['name' => 'DEMAK', 'type' => 'Kota'],
        ];
        
        $filteredCities = array_filter($allCities, function ($city) use ($desiredCities) {
            $cityName = strtoupper($city['city_name']);
            $cityType = strtoupper($city['type']);
        
            foreach ($desiredCities as $desiredCity) {
                if ($cityName === strtoupper($desiredCity['name']) && $cityType === strtoupper($desiredCity['type'])) {
                    return true;
                }
            }
        
            return false;
        });

        $transaction_details = TransactionDetailModel::where('transaction_detail_transaction_uuid', $transaction_uuid)->get();

        $data['cities'] = $filteredCities;
        $data['province'] = $response_provinces['rajaongkir']['results'];
        $data['transaction'] = TransactionModel::where('transaction_uuid', $transaction_uuid)->first();
        $data['transaction_weight'] = 0;

        foreach ($transaction_details as $transaction_detail) {
            $data['transaction_weight'] += $transaction_detail->product->product_weight * 1000 * $transaction_detail->transaction_detail_quantity;
        }

        return view('customer.address', ['data' => $data]);
    }

    public function checkOngkir (Request $request) {
        try {
            $data = [
                'origin' => $request->origin,
                'destination' => $request->destination,
                'weight' => $request->weight,
                'courier' => $request->courier,
            ];
    
            $response = Http::asForm()->withHeaders([
                'key' => 'ecefea7e4a9a75ca38e6246566b02588',
            ])->post('https://api.rajaongkir.com/starter/cost', $data);  // API Untuk Check Ongkir
        
            return response()->json($response->json());
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
                'data' => []
            ]);
        }
    }
    
    public function store (Request $request, string $transaction_uuid) {
        $data = [
            'transaction_delivery_transaction_uuid' => $transaction_uuid,
            'transaction_delivery_province' => $request->transaction_delivery_province,
            'transaction_delivery_city' => $request->transaction_delivery_city,
            'transaction_delivery_address' => $request->transaction_delivery_address,
            'transaction_delivery_weight' => $request->transaction_delivery_weight,
            'transaction_delivery_service' => $request->transaction_delivery_service,
            'transaction_delivery_shippingcost' => $request->transaction_delivery_shippingcost,
        ];

        $delivery = TransactionDeliveryModel::create($data);

        if ($delivery) {
            return redirect()->route('customer.detail_payment', ['transaction_uuid' => $transaction_uuid]);
        } else {
            return redirect()->back()->with('error', 'Failed to add address!');
        }
    }
}
