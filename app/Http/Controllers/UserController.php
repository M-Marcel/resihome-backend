<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
// use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(auth()->user()->id);
        // dd($user);
        return response($user);
    }

    public function allUser()
    {
        $allUser = User::whereIs_superadmin(0)->get();
        // dd($user);
        return response($allUser);
    }

    public function totaluser()
    {
        $allUser = User::all();
        // dd($user);
        return response($allUser);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'string|email|max:255|unique:users',
            'firstName' => 'string',
            'lastName' => 'string',
            'postalCode' => 'string',
            'phoneNumber' => 'string',
            'address' => 'string',
            'city' => 'string',
            'state' => 'string',
            'country' => 'string',
            'image' => 'sometimes|file|image|max:4000',
        ]);

        if($request->hasFile('image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Check if path exist
            $path = "public/photo/profile";
            // $path = "public/images/userImages";

            if(!Storage::exists($path)){
                Storage::makeDirectory($path, 0775, true, true);
            }
            // Upload Image
            $path = $request->file('image')->storeAs('public/photo/profile', $fileNameToStore);
            // $path = $request->file('image')->storeAs('public/images/userImages', $fileNameToStore);

             // make thumbnails
	    $thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
        // $thumb = Image::make($request->file('image')->getRealPath());
        // $thumb->resize(80, 80);
        // $thumb->save('storage/images'.$thumbStore);
        // $thumb->save('storage/images/'.$thumbStore);

        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $user = new User([

        'user_role' =>  2,
        'password' =>  $request->get('password'),
        'email' =>  $request->get('email'),
        'firstname' =>  $request->get('firstName'),
        'lastname' => $request->get('lastName'),
        'postal_code' => $request->get('postalCode'),
        'phone_number' => $request->get('phoneNumber'),
        'address' => $request->get('address'),
        'city' => $request->get('city'),
        'state' => $request->get('state'),
        'country' => $request->get('country')

            ]);

        $user->save();

        return response([

           'user' => $user,
           'message' => 'User Created Successfully'

            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
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

        $user = User::find(Auth::user()->id);

        if($request->hasFile('image')){

            //get filename with extension
        $filenamewithextension = $request->file('image')->getClientOriginalName();

        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

        //get file extension
        $extension = $request->file('image')->getClientOriginalExtension();

        //filename to store
        $filenametostore = $filename.'_'.time().'.'.$extension;

        if ($user->image !== null){
            Storage::disk('s3')->delete($user->image);
        }

        //Upload File to s3
        Storage::disk('s3')->put($filenametostore, fopen($request->file('image'), 'r+'), 'public');
    }
        if ($request->get('firstName') === null){
            $user->firstname =  $user->firstname;
        }else{
            $user->firstname = $request->get('firstName');
        };
        if ($request->get('lastName') === null){
            $user->lastname =  $user->lastname;
        }else{
            $user->lastname = $request->get('lastName');
        };
        if ($request->get('postalCode') === null){
            $user->postal_code =  $user->postal_code;
        }else{
            $user->postal_code = $request->get('postalCode');
        };
        if ($request->get('phoneNumber') === null){
            $user->phone_number =  $user->phone_number;
        }else{
            $user->phone_number = $request->get('phoneNumber');
        };
        if ($request->get('address') === null){
            $user->address =  $user->address;
        }else{
            $user->address = $request->get('address');
        };
        if ($request->get('city') === null){
            $user->city =  $user->city;
        }else{
            $user->city = $request->get('city');
        };
        if ($request->get('state') === null){
            $user->state =  $user->state;
        }else{
            $user->state = $request->get('state');
        };
        if ($request->get('country') === null){
            $user->country =  $user->country;
        }else{
            $user->country = $request->get('country');
        };

        // https://resihome.s3.us-east-2.amazonaws.com/permission+template_1596447839.png

        if($request->hasFile('image')){
            $imageUrl = 'https://'. env('AWS_BUCKET') .'.s3.'. env('AWS_DEFAULT_REGION') . '.amazonaws.com/'. $filenametostore;
            $user->image = $filenametostore;
            // $user->thumbnail = $thumbStore;
            $user->imageUrl = $imageUrl;
        }
        $user->save();



        return response([

        'user' => $user,
        'message' => 'User Updated Successfully'

            ]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
