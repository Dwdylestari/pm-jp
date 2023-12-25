<?php

namespace App\Http\Controllers\General;

use App\Events\CartUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\TransactionModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register (UserRequest $request)
    {
        $validator = Validator::make($request->all(), $request->rules());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            $data = $request->validated();
            $action = User::create($data);

            return redirect()->route('general.auth.register')->with('success', 'Successfully registered, please login to continue.');
        }
    }

    public function login (Request $request) {
        $email = $request->input('email');
        $user = User::where('user_email', $email)->first();

        if ($user) {
            if (password_verify($request->input('password'), $user->user_password)) {
                Auth::login($user);
                if ($user->user_isadmin == 1) {
                    session()->put('user_name', $user->user_name);
                    return redirect()->route('admin.dashboard');
                } else {
                    $transaction = TransactionModel::where('transaction_user_uuid', auth()->user()->user_uuid)
                        ->where('transaction_ispaid', false)
                        ->first();
                    
                    if ($transaction != null) {
                        session()->put('transaction_uuid', $transaction->transaction_uuid);
                    }

                    session()->put('user_name', $user->user_name);
                    session()->put('user_uuid', $user->user_uuid);
                    event(new CartUpdated());
                    return redirect()->route('customer.dashboard');
                }
            } else {
                return redirect()->route('general.auth.login')->with('error', 'Wrong password.');
            }
        } else {
            return redirect()->route('general.auth.login')->with('error', 'Email not found.');
        }
    }

    public function logout () {
        Auth::logout();
        session()->flush();

        return redirect()->route('general.auth.login')->with('success', 'Successfully logged out.');
    }
}
