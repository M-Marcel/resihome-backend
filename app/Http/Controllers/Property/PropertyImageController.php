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
       return('testing');
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
        dd($property->property_images);

        return response([

            'Property images' => $property->property_images,
            'message' => 'Retrieved successfully'

             ]);


    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'propertyId' => 'integer',
            'image' => 'sometimes|file|image|max:5000',
        ]);

        //

        $property = Property::find($request->get('propertyId'));
        $image =  $property->property_images()
                            ->where('id', $id);


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

       if (request()->has('image')){
        $imageUrl = 'https://'. env('AWS_BUCKET') .'.s3.'. env('AWS_DEFAULT_REGION') . '.amazonaws.com/'. $filenametostore;
            // $property->property_images()->create([
            //     'original' => $filenametostore,
            //     'imageUrl' => $imageUrl,
            //     // 'thumbnail' => 'thumb'.time().$originalImage->getClientOriginalName(),
            // ]);

            $image->original = $filenametostore;
            $image->imageUrl = $imageUrl;
            $image->save();

        }

        // $image = Image::make(public_path('propertyImages/ '. $property->property_images))->fit(500, 500);
        // $image->save();

        // return response([ 'propertyImage' => PropertyResource::collection($property->property_images), 'message' => 'Retrieved successfully'], 200);

        return response([

            'Property image' => $image,
            'message' => 'Retrieved successfully'

             ]);
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
            'id' => 'integer',
        ]);

        $property = Property::find($request->get('propertyId'));

       $image =  $property->property_images()
                            ->where('id', $request->get('id'))
                            ->get();
        // $property = Property_image::where('id', $request->get('id'))
        //                             ->where('propertyId', $request->get('propertyId'))
        //                             ->get();

    //     if($request->hasFile('image')){
    //         //get filename with extension
    //        $filenamewithextension = $request->file('image')->getClientOriginalName();

    //        //get filename without extension
    //        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

    //        //get file extension
    //        $extension = $request->file('image')->getClientOriginalExtension();

    //        //filename to store
    //        $filenametostore = $filename.'_'.time().'.'.$extension;

    //        if ($property->image == $filenametostore){
    //             Storage::disk('s3')->delete($filenametostore);
    //         }

    //        //Upload File to s3
    //        Storage::disk('s3')->put($filenametostore, fopen($request->file('image'), 'r+'), 'public');
    //    }

    //    if (request()->has('image')){
    //     $imageUrl = 'https://'. env('AWS_BUCKET') .'.s3.'. env('AWS_DEFAULT_REGION') . '.amazonaws.com/'. $filenametostore;
    //         $property->property_images()->create([
    //             'original' => $filenametostore,
    //             'imageUrl' => $imageUrl,
    //             // 'thumbnail' => 'thumb'.time().$originalImage->getClientOriginalName(),
    //         ]);
    //     }

        // $image = Image::make(public_path('propertyImages/ '. $property->property_images))->fit(500, 500);
        // $image->save();

        // return response([ 'propertyImage' => PropertyResource::collection($property->property_images), 'message' => 'Retrieved successfully'], 200);
        return response([

            'Property image' => $image,
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
    }
}
