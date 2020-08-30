<?php

namespace App\Http\Controllers;

use App\SocialAccount;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

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

    public function adminLogin(Request $request)
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
            'userRole' => 'required|string',
            'firstName' => 'string',
            'lastName' => 'string',
            'postalCode' => 'string',
            'phoneNumber' => 'string',
        ]);

        return User::create([
            // 'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_role' => $request->userRole,
            'firstname' => $request->firstName,
            'lastname' => $request->lastName,
            'postal_code' => $request->postalCode,
            'phone_number' => $request->phoneNumber,
        ]);
    }

    public function adminRegister(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user =  User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_role' => '10',
            'is_admin' => 1,
            'is_superadmin' => 1,

        ]);

        $user->is_admin = 1;
        $user->is_superadmin = 1;

        $user->save();


        return response($user);
    }

    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->revoke();
        });

        return response()->json('Logged out successfully', 200);
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }


    public function handleProviderCallback($provider)
    {

        // $user = Socialite::driver('google')->user();
        $user = Socialite::driver($provider)->stateless()->user();

        if(!$user->token){
            dd('failed');
        }

        $appUser = User::whereEmail($user->email)->first();

        if(!$appUser){
            //Create user and add social account
            $appUser = User::create([
                'email' => $user->email,
                'password' => Str::random(8),
                'user_role' => 2,
                // 'user_role' => $userRole,
                'firstname' => $user->name,
                // 'lastname' => $user->name
            ]);

            $socialAccount = SocialAccount::create([
                'provider' => $provider,
                'provider_user_id' => $user->id,
                'user_id' => $appUser->id
            ]);

        }else{
            //user already exist
            $socialAccount =  $appUser->socialAccounts()->where('provider', $provider)->first();

            if(!$socialAccount){
                //create social account
                $socialAccount = SocialAccount::create([
                    'provider' => $provider,
                    'provider_user_id' => $user->id,
                    'user_id' => $appUser->id
                ]);
            }

        }
        //login our user and get the token
        $passportToken = $appUser->createToken('Login token');

        return response()->json([
            'access_token' => $passportToken
        ]);

        dd($user, $passportToken)->accessToken;
        /* HERE CREATE USER WITH YOUR APP LOGIC. If email is unique... */

        // Login the created user
        // Auth::login($user, true);
        // dd($user);

        // // Get the username (or wathever you want to return in the JWT).
        // $success['name'] = Auth::user()->name;
        // // Create a new access_token for the session (Passport)
        // $success['token'] = Auth::user()->createToken('Resihome')->accessToken;

        // // Create new view (I use callback.blade.php), and send the token and the name.
        // return response([
        //     'name' => $success['name'],
        //     'token' => $success['token'],
        // ]);



        // try {

        //     $user = Socialite::driver('google')->user();

        //     $finduser = User::where('google_id', $user->id)->first();

        //     if($finduser){

        //         Auth::login($finduser);

        //         return redirect('/home');

        //     }else{
        //         $newUser = User::create([
        //             'name' => $user->name,
        //             'email' => $user->email,
        //             'google_id'=> $user->id,
        //             'password' => encrypt('123456dummy')
        //         ]);

        //         Auth::login($newUser);

        //         return redirect('/home');
        //     }

        // } catch (Exception $e) {
        //     dd($e->getMessage());
        // }
    }
}
