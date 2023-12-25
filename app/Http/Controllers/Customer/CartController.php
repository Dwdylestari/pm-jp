<?php

namespace App\Http\Controllers\Customer;

use App\Events\CartUpdated;
use App\Http\Controllers\Controller;
use App\Models\TransactionDetailModel;
use App\Models\TransactionModel;
use App\Models\UserTransaction;
use App\Models\UserTransactionDetail;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index ()
    {
        $user = TransactionModel::where('transaction_user_uuid', auth()->user()->user_uuid)
            ->where('transaction_ispaid', false)
            ->first();

        if ($user) {
            $data['carts'] = TransactionDetailModel::where('transaction_detail_transaction_uuid', $user->transaction_uuid)
            ->join('products', 'products.product_uuid', '=', 'transaction_details.transaction_detail_product_uuid')
            ->get();
        } else {
            $data['carts'] = [];
        }

        $data['transaction'] = $user;
        return view('customer.carts', ['data' => $data]);
    }

    public function countQuantity(Request $request, string $cart_uuid)
    {
        $action = $request->query('action', 'decrement');
        
        $cart = TransactionDetailModel::where('transaction_detail_uuid', $cart_uuid)->first();
        
        if ($action === 'increment') {
            $cart->transaction_detail_quantity = $cart->transaction_detail_quantity + 1;
            $cart->transaction_detail_totalprice = $cart->transaction_detail_totalprice + $cart->product->product_price;
        } else {
            if ($cart->transaction_detail_quantity > 1) {
                $cart->transaction_detail_quantity = $cart->transaction_detail_quantity - 1;
                $cart->transaction_detail_totalPrice = $cart->transaction_detail_totalprice - $cart->product->product_price;
            }
        }
        
        $operation = $cart->save();

        if ($operation) {
            $carts = TransactionDetailModel::where('transaction_detail_transaction_uuid', $cart->transaction_detail_transaction_uuid)->get();
            $transaction = TransactionModel::where('transaction_uuid', $cart->transaction_detail_transaction_uuid)->first();
            $transaction->transaction_totalprice = $carts->sum('transaction_detail_totalprice');
            $transaction->save();
        }
    
        return response()->json(['cart' => $cart, 'transaction' => $transaction]);
    }   

    public function delete (string $cart_uuid) {
        $cart = TransactionDetailModel::where('transaction_detail_uuid', $cart_uuid)->first();
        $cart->delete();

        $transaction = TransactionModel::where('transaction_uuid', $cart->transaction_detail_transaction_uuid)->first();
        $transaction->transaction_totalprice = $transaction->transaction_totalprice - $cart->transaction_detail_totalprice;
        $transaction->save();

        $cart_count = TransactionModel::where('transaction_ispaid', false)->count();

        event(new CartUpdated());

        return redirect()->back()->with('success', 'Successfully delete product from cart!');
    }
}
