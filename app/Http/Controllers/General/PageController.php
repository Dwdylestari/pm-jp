<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index()
    {
        return view('general.index');
    }

    public function login()
    {
        return view('general.auth.login');
    }

    public function register()
    {
        return view('general.auth.register');
    }
}
