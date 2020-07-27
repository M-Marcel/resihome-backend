<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Property_image;
use App\Property;
use Illuminate\Http\Request;
use App\Http\Resources\PropertyResource;
use Intervention\Image\Facades\Image;

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
        $thumbnailImage->save($thumbnailPath.'thumb'.time().$originalImage->getClientOriginalName());

        if (request()->has('image')){
            $property->property_images()->create([
                'original' => time().$originalImage->getClientOriginalName(),
                'thumbnail' => 'thumb'.time().$originalImage->getClientOriginalName(),
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
    public function show(Property_image $property_image)
    {
        //
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
