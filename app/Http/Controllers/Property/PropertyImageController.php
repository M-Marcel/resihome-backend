<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Property_image;
use App\Property;
use Illuminate\Http\Request;
use App\Http\Resources\PropertyResource;
use Illuminate\Support\Facades\Storage;

class PropertyImageController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'propertyId' => 'integer',
            'image' => 'sometimes|file|image|max:5000',
        ]);

        //

        $property = Property::find($request->get('propertyId'));


        if($request->hasFile('image')){
            //get filename with extension
           $filenamewithextension = $request->file('image')->getClientOriginalName();

           //get filename without extension
           $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

           //get file extension
           $extension = $request->file('image')->getClientOriginalExtension();

           //filename to store
           $filenametostore = $filename.'_'.time().'.'.$extension;

           if ($property->image == $filenametostore){
                Storage::disk('s3')->delete($filenametostore);
            }

           //Upload File to s3
           Storage::disk('s3')->put($filenametostore, fopen($request->file('image'), 'r+'), 'public');
       }
       $imageUrl = 'https://'. env('AWS_BUCKET') .'.s3.'. env('AWS_DEFAULT_REGION') . '.amazonaws.com/'. $filenametostore;

        if (request()->has('image')){
            $property->property_images()->create([
                'original' => $filenametostore,
                'imageUrl' => $imageUrl,
                // 'thumbnail' => 'thumb'.time().$originalImage->getClientOriginalName(),
            ]);
        }

        // $image = Image::make(public_path('propertyImages/ '. $property->property_images))->fit(500, 500);
        // $image->save();

        return response([ 'propertyImage' => PropertyResource::collection($property->property_images), 'message' => 'Retrieved successfully'], 200);

    }

    public function update(Request $request)
    {
        $request->validate([
            'propertyId' => 'integer',
            'image' => 'sometimes|file|image|max:5000',
        ]);

        //

        $property = Property::find($request->get('propertyId'));


        if($request->hasFile('image')){
            //get filename with extension
           $filenamewithextension = $request->file('image')->getClientOriginalName();

           //get filename without extension
           $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

           //get file extension
           $extension = $request->file('image')->getClientOriginalExtension();

           //filename to store
           $filenametostore = $filename.'_'.time().'.'.$extension;

           if ($property->image == $filenametostore){
                Storage::disk('s3')->delete($filenametostore);
            }

           //Upload File to s3
           Storage::disk('s3')->put($filenametostore, fopen($request->file('image'), 'r+'), 'public');
       }
       $imageUrl = 'https://'. env('AWS_BUCKET') .'.s3.'. env('AWS_DEFAULT_REGION') . '.amazonaws.com/'. $filenametostore;

        if (request()->has('image')){
            $property->property_images()->create([
                'original' => $filenametostore,
                'imageUrl' => $imageUrl,
                // 'thumbnail' => 'thumb'.time().$originalImage->getClientOriginalName(),
            ]);
        }

        // $image = Image::make(public_path('propertyImages/ '. $property->property_images))->fit(500, 500);
        // $image->save();

        return response([ 'propertyImage' => PropertyResource::collection($property->property_images), 'message' => 'Retrieved successfully'], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property_image  $property_image
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        $request->validate([
            'propertyId' => 'integer',
            'image' => 'sometimes|file|image|max:5000',
        ]);

        $property = Property::find($propertyId);

        if($request->hasFile('image')){
            //get filename with extension
           $filenamewithextension = $request->file('image')->getClientOriginalName();

           //get filename without extension
           $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

           //get file extension
           $extension = $request->file('image')->getClientOriginalExtension();

           //filename to store
           $filenametostore = $filename.'_'.time().'.'.$extension;

           if ($property->image == $filenametostore){
                Storage::disk('s3')->delete($filenametostore);
            }

           //Upload File to s3
           Storage::disk('s3')->put($filenametostore, fopen($request->file('image'), 'r+'), 'public');
       }
       $imageUrl = 'https://'. env('AWS_BUCKET') .'.s3.'. env('AWS_DEFAULT_REGION') . '.amazonaws.com/'. $filenametostore;

        if (request()->has('image')){
            $property->property_images()->create([
                'original' => $filenametostore,
                'imageUrl' => $imageUrl,
                // 'thumbnail' => 'thumb'.time().$originalImage->getClientOriginalName(),
            ]);
        }

        // $image = Image::make(public_path('propertyImages/ '. $property->property_images))->fit(500, 500);
        // $image->save();

        return response([ 'propertyImage' => PropertyResource::collection($property->property_images), 'message' => 'Retrieved successfully'], 200);



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property_image  $property_image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'propertyId' => 'integer',
            'image' => 'sometimes|file|image|max:5000',
        ]);

        // $imageName = time().'.'.$request->image->extension();

        // $request->image->move(public_path('propertyImages'), $imageName);

        $property = Property::find(64);

        // $property->property_images()->create([
        //     'original' => 'MainImage.png',
        // ]);

        $originalImage= $request->file('image');
        $thumbnailImage = Image::make($originalImage);
        $thumbnailPath = public_path().'/storage/thumbnail/';
        $originalPath = public_path().'/storage/propertyImages/';
        $thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
        $thumbnailImage->resize(150,150);
        $thumbnailImage->save($thumbnailPath.time().$originalImage->getClientOriginalName());

        $oldImage = Property_image::find($id);
        $oldImage->original = time().$originalImage->getClientOriginalName();

        $property->property_images()->save();




        // $image = Image::make(public_path('propertyImages/ '. $property->property_images))->fit(500, 500);
        // $image->save();

        return response([ 'property' => PropertyResource::collection($property->property_images), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property_image  $property_image
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Property_image::findOrFail($id);
        $image->delete();
    }
}
