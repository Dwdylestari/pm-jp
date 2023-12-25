<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index ()
    {
        $data['admins'] = User::getAdmins();

        return view('customer.contacts', ['data' => $data]);
    }
}
