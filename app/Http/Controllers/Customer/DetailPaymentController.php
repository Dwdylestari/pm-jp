<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethodModel;
use App\Models\TransactionModel;
use App\Models\TransactionPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailPaymentController extends Controller
{
    public function index (string $transaction_uuid) {
        $data['detail_payment'] = TransactionModel::with('user', 'transaction_detail', 'transaction_delivery')->where('transaction_uuid', $transaction_uuid)->first();
        $data['banks'] = PaymentMethodModel::with('bank')->where('paymentmethod_user_uuid', session()->get('user_uuid'))->get();

        return view('customer.detail_payment', ['data' => $data]);
    }

    public function store (Request $request) {
        $data = [
            'transaction_payment_transaction_uuid' => session()->get('transaction_uuid'),
            'transaction_payment_payment_method_uuid' => $request->input('transaction_payment_payment_method_uuid'),
        ];

        $action = TransactionPayment::create($data);

        if ($action) {
            return redirect()->route('customer.payment');
        } else {
            return redirect()->back();
        }
    }
}
