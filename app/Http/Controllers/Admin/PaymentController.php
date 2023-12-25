<?php

namespace App\Http\Controllers\Admin;

use App\Events\CartUpdated;
use App\Http\Controllers\Controller;
use App\Models\TransactionModel;
use App\Models\TransactionPayment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index () {
        $data['transaction'] = TransactionModel::with('user', 'transaction_payment')
            ->whereHas('transaction_payment', function ($query) {
                $query->where('transaction_payment_status', 'Pending');
            })->get();
    
        return view('admin.payments.index', ['data' => $data]);
    }

    public function update (string $transaction_payment_uuid) {
        $transaction_payment = TransactionPayment::where('transaction_payment_uuid', $transaction_payment_uuid)->first();
        $transaction_payment->transaction_payment_status = 'Paid';
        $transaction_payment->save();

        $transaction = TransactionModel::where('transaction_uuid', $transaction_payment->transaction_payment_transaction_uuid)->first();
        $transaction->transaction_ispaid = true;
        $transaction->save();

        event(new CartUpdated());

        return redirect()->back()->with('success', 'Payment successfully confirmed.');
    }
}
