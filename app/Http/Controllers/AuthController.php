<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $http = new \GuzzleHttp\Client;
        // try{
        //     $response = $http->post('http://127.0.0.1:8000/oauth/token', [
        //         'form_params' => [
        //             'grant_type' => 'password',
        //             'client_id' => '90f97333-7de6-4b0f-b06b-3d62d49dc372',
        //             'client_secret' => '3ZTh1CCFqTYu6VC2obVkwtAKE3F9goKezK8VA7hA',
        //             'redirect_uri' => 'http://127.0.0.1:8000',
        //             'username' => $request->username,
        //             'passowrd' => $request->password,
        //         ]
        //     ]);
        //     return $response->getBody();

        // }
        try {
            $response = $http->post(config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->username,
                    'password' => $request->password,
                ]
            ]);
            return $response->getBody();
      }catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if ($e->getCode() === 400) {
                return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
            } else if ($e->getCode() === 401) {
                return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
            }

            return response()->json('Something went wrong on the server.', $e->getCode());
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'user_role' => 'required|integer|max:2',
            'firstname' => 'string',
            'lastname' => 'string',
            'postal_code' => 'string',
            'phone_number' => 'string',
        ]);

        return User::create([
            // 'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_role_id' => $request->user_role,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'postal_code' => $request->postal_code,
            'phone_number' => $request->phone_number,
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->revoke();
        });

        return response()->json('Logged out successfully', 200);
    }
}
