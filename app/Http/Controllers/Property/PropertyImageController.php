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
    public function index($id)
    {
        $property = Property::findOrFail($id);
        return response([

            'Property images' => $property->property_images,
            'message' => 'Images retrieved successfully'

             ]);
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

        // $property = Property::find($request->get('propertyId'))->get();
        $property = $property = Property::findOrFail($request->get('propertyId'));


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
           $imageUrl = 'https://'. env('AWS_BUCKET') .'.s3.'. env('AWS_DEFAULT_REGION') . '.amazonaws.com/'. $filenametostore;
       }

       if (request()->has('image')){
            $property->property_images()->create([
                'original' => $filenametostore,
                'imageUrl' => $imageUrl,
                // 'thumbnail' => 'thumb'.time().$originalImage->getClientOriginalName(),
            ]);
        }

        // $image = Image::make(public_path('propertyImages/ '. $property->property_images))->fit(500, 500);
        // $image->save();

        // return response([ 'propertyImage' => PropertyResource::collection($property->property_images), 'message' => 'Retrieved successfully'], 200);
        // dd($property->property_images);

        return response([

            'Property images' => $property->property_images,
            'message' => 'Stored successfully'

             ]);


    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'propertyId' => 'integer',
            'image' => 'sometimes|file|image|max:5000',
        ]);


        $property = Property::find($request->get('propertyId'));
        $image =  $property->property_images()
                            ->whereId($id);

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
        // return response($image->get()[0]['original']);
        Storage::disk('s3')->delete($image->get()[0]['original']);

       if (request()->has('image')){
        $imageUrl = 'https://'. env('AWS_BUCKET') .'.s3.'. env('AWS_DEFAULT_REGION') . '.amazonaws.com/'. $filenametostore;
            $image->update([
                "original" => $filenametostore,
                "imageUrl" => $imageUrl
            ]);

        }
        return response([

            'Property image' => Property_image::find($id),
            'message' => 'updated successfully'

             ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property_image  $property_image
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response([

            'Property image' => Property_image::findOrFail($id),
            'message' => 'Retrieved successfully'

             ]);


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

        return response([

            'message' => 'Deleted successfully'

             ]);
    }
}
