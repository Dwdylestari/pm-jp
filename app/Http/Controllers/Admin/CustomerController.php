<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index ()
    {
        $data['customers'] = User::getCustomers();

        return view('admin.customers.index', ['data' => $data]);
    }
}
