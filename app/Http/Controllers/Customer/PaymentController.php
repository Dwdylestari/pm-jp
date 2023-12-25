<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethodModel;
use App\Models\TransactionModel;
use App\Models\TransactionPayment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index () {
        $data['transaction'] = TransactionModel::with('transaction_payment', 'transaction_delivery')
            ->where('transaction_user_uuid', auth()->user()->user_uuid)
            ->where('transaction_ispaid', 0)
            ->first();
        if ($data['transaction']) {
            $data['transaction_payment'] = TransactionPayment::with('paymentmethod')
            ->where('transaction_payment_transaction_uuid', $data['transaction']->transaction_uuid)
            ->first();
            if ($data['transaction_payment']) {
                $data['paymentmethod'] = PaymentMethodModel::with('bank')->where('paymentmethod_uuid', $data['transaction_payment']->transaction_payment_payment_method_uuid)->first();
            }
        } else {
            $data['transaction_payment'] = null;
            $data['paymentmethod'] = null;
        }

        return view('customer.payment', ['data' => $data]);
    }

    public function update (string $transaction_payment_uuid) {
        $transaction_payment = TransactionPayment::where('transaction_payment_uuid', $transaction_payment_uuid)->first();
        $transaction_payment->transaction_payment_status = 'Pending';
        $transaction_payment->save();

        $transaction = TransactionModel::with('transaction_delivery')->where('transaction_uuid', $transaction_payment->transaction_payment_transaction_uuid)->first();
        $transaction->transaction_totalprice = $transaction->transaction_totalprice + $transaction->transaction_delivery->transaction_delivery_shippingcost;
        $transaction->save();

        return redirect()->back()->with('success', 'Payment successfully confirmed, please wait for the admin to confirm your payment.');
    }
}
