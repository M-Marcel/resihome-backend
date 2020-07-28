<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'email' => 'string|email|max:255|unique:users',
        //     'firstName' => 'string',
        //     'lastName' => 'string',
        //     'postalCode' => 'string',
        //     'phoneNumber' => 'string',
        //     'address' => 'string',
        //     'city' => 'string',
        //     'state' => 'string',
        //     'country' => 'string',
        //     'image' => 'sometimes|file|image|max:4000',
        // ]);

        // if($request->hasFile('image')){
        //     // Get filename with the extension
        //     $filenameWithExt = $request->file('image')->getClientOriginalName();
        //     // Get just filename
        //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //     // Get just ext
        //     $extension = $request->file('image')->getClientOriginalExtension();
        //     // Filename to store
        //     $fileNameToStore= $filename.'_'.time().'.'.$extension;
        //     // Upload Image
        //     $path = $request->file('image')->storeAs('public/images/userImages', $fileNameToStore);

        //      // make thumbnails
	    // $thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
        // $thumb = Image::make($request->file('image')->getRealPath());
        // $thumb->resize(80, 80);
        // $thumb->save('storage/images/'.$thumbStore);

        // } else {
        //     $fileNameToStore = 'noimage.jpg';
        // }

        // $user = new User([

        // 'user_role' =>  2,
        // 'password' =>  $request->get('password'),
        // 'email' =>  $request->get('email'),
        // 'firstname' =>  $request->get('firstName'),
        // 'lastname' => $request->get('lastName'),
        // 'postal_code' => $request->get('postalCode'),
        // 'phone_number' => $request->get('phoneNumber'),
        // 'address' => $request->get('address'),
        // 'city' => $request->get('city'),
        // 'state' => $request->get('state'),
        // 'country' => $request->get('country')

        //     ]);

        // $user->save();

        // return response([

        //    'user' => $user,
        //    'message' => 'User Created Successfully'

        //     ]);
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
    public function update(Request $request, $id)
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
            'image' => 'sometimes|file|image|max:4000',
        ]);

        $user = User::find($id);
        // $user = User::find(auth()->user()->id);

        if($request->hasFile('image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/images/userImages', $fileNameToStore);
            // Delete file if exists
            Storage::delete('public/images/'.$user->image);

	   //Make thumbnails
	    $thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
            $thumb = Image::make($request->file('image')->getRealPath());
            $thumb->resize(80, 80);
            $thumb->save('storage/images/'.$thumbStore);

        }

        $user->email =  $user['email'];
        $user->password =  $user['password'];
        $user->user_role =  $user['user_role'];
        $user->firstname =  $request->get('firstName');
        $user->firstname =  $request->get('firstName');
        $user->lastname = $request->get('lastName');
        $user->postal_code = $request->get('postalCode');
        $user->phone_number = $request->get('phoneNumber');
        $user->address = $request->get('address');
        $user->city = $request->get('city');
        $user->state = $request->get('state');
        $user->country = $request->get('country');


        if($request->hasFile('image')){
            $user->image = $fileNameToStore;
            $user->thumbnail = $thumbStore;
        }
        $user->save();

        return response([

        'property' => $user,
        'message' => 'User Updated Successfully'

            ]);


        // $thumbnailPath = public_path().'/storage/users/thumbnail/';
        // $originalPath = public_path().'/storage/users/original/';
        // if(!File::isDirectory($thumbnailPath)){
        //     File::makeDirectory($thumbnailPath, 0777, true, true);
        // }
        // if(!File::isDirectory($originalPath)){
        //     File::makeDirectory($originalPath, 0777, true, true);
        // }

        // $originalImage= $request->file('image');
        // $thumbnailImage = Image::make($originalImage);
        // $thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
        // $thumbnailImage->resize(150,150);
        // $thumbnailImage->save($thumbnailPath.'thumbnail'.time().$originalImage->getClientOriginalName());

        // $user->image = time().$originalImage->getClientOriginalName();
        // $user->thumbnail = 'thumb'.time().$originalImage->getClientOriginalName();


        // $user->save();

        // return response($user, 200);
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
