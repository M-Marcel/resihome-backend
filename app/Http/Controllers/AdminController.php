<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    // public function adminRegister(Request $request)
    // {
    //     $admin = Admin::find(Auth::user()->id);
    //     $request->validate([
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:6',
    //     ]);

    //     if ($admin->is_superadmin == 1){

    //         $admin =  Admin::create([
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'user_role' => '10',
    //         'is_admin' => 1,

    //     ]);

    //     $admin->is_admin = 1;
    //     $admin->save();
    //     return response($admin);

    //     }else{

    //         return response(['message' => 'Unauthorized access']);
    //     }

    // }

    public function blockUser($id)
    {
        $admin = Admin::find(Auth::user()->id);
        // $request->validate([
        //     'id' => 'required|integer',
        // ]);
// dd($id);
        if ($admin->is_superadmin == 1){

            $user = Admin::findOrFail($id);
             if($user->is_active == 0){
                $user->is_active = 1;
                $user->save();
                return response([
                    'user' => $user,
                    'message' => 'User unbloked',
                    ]);
             }elseif($user->is_active == 1){
                $user->is_active = 0;
                $user->save();
                return response([
                    'user' => $user,
                    'message' => 'User Bloked',
                    ]);
             }

        }

        else{

            return response(['message' => 'Unauthorized access ']);
        }

        // return response([
        //     'user' => $user,
        //     'message' => 'User Bloked',
        //     ]);
    }

    public function blockAdmin($id)
    {
        $admin = Admin::find(Auth::user()->id);
        // $request->validate([
        //     'id' => 'required|integer',
        // ]);
// dd($id);
        if ($admin->is_superadmin == 1){

            $user = Admin::findOrFail($id);
             if($user->is_admin == 0){
                $user->is_admin = 1;
                $user->save();
                return response([
                    'user' => $user,
                    'message' => 'Admin unbloked',
                    ]);
             }elseif($user->is_admin == 1){
                $user->is_admin = 0;
                $user->save();
                return response([
                    'user' => $user,
                    'message' => 'Admin Blocked',
                    ]);
             }

        }

        else{

            return response(['message' => 'Unauthorized access only the Super Admin has can add an Admin']);
        }

        // return response([
        //     'user' => $user,
        //     'message' => 'User Bloked',
        //     ]);
    }

    public function adminSwitch()
    {
        $user = Admin::findOrFail(Auth::user()->id);
             if($user->is_admin == 0){
                $user->is_admin = 1;
                $user->save();
                return response([
                    'user' => $user,
                    'message' => 'User upgraded to an admin',
                    ]);
             }elseif($user->is_admin == 1){
                $user->is_admin = 0;
                $user->save();
                return response([
                    'user' => $user,
                    'message' => 'Admin demoted to user',
                    ]);
             }

        }

    public function superAdminSwitch()
    {
        $user = Admin::findOrFail(Auth::user()->id);
             if($user->is_superadmin == 0){
                $user->is_superadmin = 1;
                $user->save();
                return response([
                    'user' => $user,
                    'message' => 'Admin upgraded to an SuperAdmin',
                    ]);
             }elseif($user->is_superadmin == 1){
                $user->is_superadmin = 0;
                $user->save();
                return response([
                    'user' => $user,
                    'message' => 'SuperAdmin demoted to Admin',
                    ]);
             }

        }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $admin = Admin::find(Auth::user()->id);

        if ($admin->is_admin == 1){

            return response([ 'Admin' => $admin, 'message' => 'Admin Retrieved successfully'], 200);
        }else{

            return response(['message' => 'Unauthorized access']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {

        $admin = Admin::find(Auth::user()->id);

        if ($admin->is_admin == 1){
        $request->validate([
            // 'email' => 'string|email|max:255|unique:users',
            'firstName' => 'string',
            'lastName' => 'string',
            'postalCode' => 'string',
            'phoneNumber' => 'string',
            'address' => 'string',
            'city' => 'string',
            'state' => 'string',
            'country' => 'string',
            'image' => 'image|mimes:jpeg,png|max:4000',
        ]);

        $admin = Admin::find(Auth::user()->id);

        if($request->hasFile('image')){

            //get filename with extension
        $filenamewithextension = $request->file('image')->getClientOriginalName();

        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

        //get file extension
        $extension = $request->file('image')->getClientOriginalExtension();

        //filename to store
        $filenametostore = $filename.'_'.time().'.'.$extension;

        if ($admin->image !== null){
            Storage::disk('s3')->delete($admin->image);
        }

        //Upload File to s3
        Storage::disk('s3')->put($filenametostore, fopen($request->file('image'), 'r+'), 'public');
    }
        if ($request->get('firstName') === null){
            $admin->firstname =  $admin->firstname;
        }else{
            $admin->firstname = $request->get('firstName');
        };
        if ($request->get('lastName') === null){
            $admin->lastname =  $admin->lastname;
        }else{
            $admin->lastname = $request->get('lastName');
        };
        if ($request->get('postalCode') === null){
            $admin->postal_code =  $admin->postal_code;
        }else{
            $admin->postal_code = $request->get('postalCode');
        };
        if ($request->get('phoneNumber') === null){
            $admin->phone_number =  $admin->phone_number;
        }else{
            $admin->phone_number = $request->get('phoneNumber');
        };
        if ($request->get('address') === null){
            $admin->address =  $admin->address;
        }else{
            $admin->address = $request->get('address');
        };
        if ($request->get('city') === null){
            $admin->city =  $admin->city;
        }else{
            $admin->city = $request->get('city');
        };
        if ($request->get('state') === null){
            $admin->state =  $admin->state;
        }else{
            $admin->state = $request->get('state');
        };
        if ($request->get('country') === null){
            $admin->country =  $admin->country;
        }else{
            $admin->country = $request->get('country');
        };

        // https://resihome.s3.us-east-2.amazonaws.com/permission+template_1596447839.png

        if($request->hasFile('image')){
            $imageUrl = 'https://'. env('AWS_BUCKET') .'.s3.'. env('AWS_DEFAULT_REGION') . '.amazonaws.com/'. $filenametostore;
            $admin->image = $filenametostore;
            // $admin->thumbnail = $thumbStore;
            $admin->imageUrl = $imageUrl;
        }
        $admin->save();



        return response([

        'admin' => $admin,
        'message' => 'Admin Updated Successfully'

            ]);

        }else{

            return response(['message' => 'Unauthorized access']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $admin = Admin::find(Auth::user()->id);

        if ($admin->is_admin == 1){

            $admin->delete();

            return response(['message' => 'Admin Deleted successfully']);
        }else{

            return response(['message' => 'Unauthorized access']);
        }

    }
}
