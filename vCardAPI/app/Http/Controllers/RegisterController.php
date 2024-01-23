<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterVcardRequest;
use App\Models\Vcard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;

class RegisterController extends Controller
{
    public function insert(Request $request)
    {
        $input = $request->all();

        Vcard::create([
            'phone_number' => $input['phone_number'],
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']), //dá erro mas funciona
            'confirmation_code' => Hash::make($input['confirmation_code']), //dá erro mas funciona

        ]);
        return response()->json(['status' => true, 'message' => "Registration success"]);
    }
}
