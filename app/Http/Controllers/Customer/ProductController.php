<?php

namespace App\Http\Controllers\Customer;

use App\Events\CartUpdated;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductModel;
use App\Models\TransactionDetailModel;
use App\Models\TransactionModel;
use App\Models\UserTransaction;
use App\Models\UserTransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index ()
    {
        $transaction = TransactionModel::where('transaction_user_uuid', auth()->user()->user_uuid)
            ->where('transaction_isPaid', false)
            ->first();

        $data['boards'] = ProductModel::get_product_papan();
        $data['equipments'] = ProductModel::get_product_perlengkapan();

        if ($transaction != null) {
            $data['transaction_details'] = TransactionDetailModel::where('transaction_detail_transaction_uuid', $transaction->transaction_uuid)
                ->join('products', 'products.product_uuid', '=', 'transaction_details.transaction_detail_product_uuid')
                ->get();
        } else {
            $data['transaction_details'] = null;
        }

        return view('customer.products', ['data' => $data]);
    }

    public function store (Request $request, string $product_uuid) {
        if (session()->has('transaction_uuid')) {
            $product = ProductModel::where('product_uuid', $product_uuid)->first();
            $transaction_details = TransactionDetailModel::where('transaction_detail_transaction_uuid', session()->get('transaction_uuid'))->get();
            $transaction = TransactionModel::where('transaction_uuid', session()->get('transaction_uuid'))->first();

            $transaction_detail = [
                'transaction_detail_transaction_uuid' => session()->get('transaction_uuid'),
                'transaction_detail_product_uuid' => $product_uuid,
                'transaction_detail_uuid' => Str::uuid(),
                'transaction_detail_quantity' => 1,
                'transaction_detail_totalprice' => $product->product_price * 1,
            ];

            TransactionDetailModel::create($transaction_detail);
            
            $transaction->transaction_totalprice = $transaction->transaction_totalprice + ($product->product_price * 1);
            $transaction->save();

            event(new CartUpdated());
            return redirect()->back()->with('success', 'Successfully add product to cart!');
        } else {
            $product = ProductModel::where('product_uuid', $product_uuid)->first();
            $transaction_count = TransactionModel::count() ?? 0;
            $transaction = [
                'transaction_user_uuid' => auth()->user()->user_uuid,
                'transaction_uuid' => Str::uuid(),
                'transaction_totalprice' => $product->product_price * 1,
                'transaction_ispaid' => false
            ];
            $transaction_detail = [
                'transaction_detail_transaction_uuid' => $transaction['transaction_uuid'],
                'transaction_detail_product_uuid' => $product_uuid,
                'transaction_detail_uuid' => Str::uuid(),
                'transaction_detail_quantity' => 1,
                'transaction_detail_totalprice' => $product->product_price * 1,
            ];

            TransactionModel::create($transaction);
            TransactionDetailModel::create($transaction_detail);
            session()->put('transaction_uuid', $transaction['transaction_uuid']);

            event(new CartUpdated());

            return redirect()->back()->with('success', 'Successfully add product to cart!');
        }
    }
}
