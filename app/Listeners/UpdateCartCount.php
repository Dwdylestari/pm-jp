<?php

namespace App\Listeners;

use App\Events\CartUpdated;
use App\Models\TransactionDetailModel;
use App\Models\TransactionModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UpdateCartCount
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CartUpdated $event): void
    {
        $transaction = TransactionModel::where('transaction_ispaid', false)->first();
        $cart_count = 0;
        if ($transaction !== null) {
            $cart_count = TransactionDetailModel::where('transaction_detail_transaction_uuid', $transaction->transaction_uuid)->count();
            session()->put('cart_count', $cart_count);
            session()->save();
        }

        Log::info('Cart count updated: ' . $cart_count);
    }
}
