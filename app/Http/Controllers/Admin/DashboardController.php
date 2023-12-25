<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductModel;
use App\Models\TransactionPayment;
use App\Models\User;

class DashboardController extends Controller
{
    public function index ()
    {
        $data['product_count'] = ProductModel::count();
        $data['customer_count'] = User::getCustomers()->count();
        $data['payment_count'] = TransactionPayment::where('transaction_payment_status', 'Pending')->count();

        return view('admin.index', ['data' => $data]);
    }
}
