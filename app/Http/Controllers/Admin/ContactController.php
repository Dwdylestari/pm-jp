<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index ()
    {
        $data['admins'] = User::getAdmins();

        return view('admin.contacts.index', ['data' => $data]);
    }

    public function store (UserRequest $request)
    {
        $validator = Validator::make($request->all(), $request->rules());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            $data = $request->validated();
            $data['user_isAdmin'] = true;
            $action = User::create($data);

            return redirect()->route('admin.contact.index')->with('success', 'Successfully add admin contact!');
        }
    }
}
