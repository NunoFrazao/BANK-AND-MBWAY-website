<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AuthController extends Controller
{
    private function passportAuthenticationData($phone_number, $password, $confirmation_code)
    {

        return [
            'grant_type' => 'password',
            'client_id' => env('PASSPORT_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_SECRET'),
            'username' => $phone_number,
            'password' => $password,
            'confirmation_code' => $confirmation_code,
            'scope' => ''
        ];
    }
    public function login(Request $request)
    {
        try {
            //dd(request()->request->all());
            request()->request->add(
                $this->passportAuthenticationData($request->phone_number, $request->password, $request->confirmation_code)
            );

            $request = Request::create(
                env('PASSPORT_SERVER_URL') . '/oauth/token',
                'POST'
            );

            $response = Route::dispatch($request);
            $errorCode = $response->getStatusCode();
            $auth_server_response = json_decode((string) $response->content(), true);
            return response()->json($auth_server_response, $errorCode);
        } catch (\Exception $e) {
            return response()->json('Authentication has failed!', 401);
        }
    }
    public function logout(Request $request)
    {

        $accessToken = $request->user()->token();
        $token = $request->user()->tokens->find($accessToken);
        $token->revoke();
        $token->delete();
        return response(['msg' => 'Token revoked'], 200);
    }
}
