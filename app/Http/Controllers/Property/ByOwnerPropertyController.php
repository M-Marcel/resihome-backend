<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Property;
use Illuminate\Http\Request;
use App\Http\Resources\PropertyResource;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class ByOwnerPropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $properties = Property::where('category', 'For sale by owner')->get();

        return PropertyResource::collection($properties);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            // 'ownerId' => 'sometimes',
            'agentId' => 'required|integer',
            'category' => 'required',
            'address' => 'required',
            'location' => 'required',
            'description' => 'required',
            'type' => 'required',
            'subType' => 'required',
            'homeType' => 'required',
            'status' => 'sometimes',
            'bedroom' => 'required|integer',
            'bathroom' => 'required|integer',
            'halfBedroom' => 'required|integer',
            'quarterBedroom' => 'required|integer',
            'threeQuarterBedroom' => 'required|integer',
            'size' => 'required',
            'mainPrize' => 'required',
            'sizePrize' => 'sometimes',
            'estimatePrize' => 'required',
            'yearBuilt' => 'required',
            'heating' => 'required',
            'cooling' => 'required',
            'parking' => 'required',
            'lotSize' => 'required',
            'story' => 'required|integer',
            'internetTv' => 'required',
            'newConstruction' => 'required',
            'majorRemodelYear' => 'required',
            'taxValue' => 'required',
            'annualTaxAmount' => 'required',
            'neighborhood' => 'required',
            'transport' => 'required|boolean',
            'shopping' =>'required|boolean',
            'school' => 'required|boolean',
            'swimmimgPool' => 'required|boolean',
            'gym' => 'required|boolean',
            'city' => 'required|boolean',
            'water' => 'required|boolean',
            'park' => 'required|boolean',
            // 'concierge' => 'required',
            'image' => 'required|file|image|max:5000',

        ]);


        // Handle File Upload
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
            $path = $request->file('image')->storeAs('public/images/propertyImages', $fileNameToStore);

             // make thumbnails
	    $thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
        $thumb = Image::make($request->file('image')->getRealPath());
        $thumb->resize(80, 80);
        $thumb->save('storage/images/'.$thumbStore);

        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $property = new Property([
            'owner_id' => auth()->user()->id,
            'agent_id' => $request->get('agentId'),
            'category' => $request->get('category'),
            'address' => $request->get('category'),
            'location' => $request->get('address'),
            'description' => $request->get('description'),
            'type' => $request->get('type'),
            'sub_type' => $request->get('subType'),
            'home_type' => $request->get('homeType'),
            'status' => $request->get('status'),
            'bedroom' => $request->get('bedroom'),
            'bathroom' => $request->get('bathroom'),
            'half_bedroom' => $request->get('halfBedroom'),
            'quarter_bedroom' => $request->get('quarterBedroom'),
            'three_quarter_bedroom' => $request->get('threeQuarterBedroom'),
            'size' => $request->get('size'),
            'main_prize' => $request->get('mainPrize'),
            'size_prize' => $request->get('sizePrize'),
            'estimate_prize' => $request->get('estimatePrize'),
            'year_built' => $request->get('yearBuilt'),
            'heating' => $request->get('heating'),
            'cooling' => $request->get('cooling'),
            'parking' => $request->get('parking'),
            'lot_size' => $request->get('lotSize'),
            'story' => $request->get('story'),
            'internet_tv' => $request->get('internetTv'),
            'new_construction' => $request->get('newConstruction'),
            'major_remodel_year' => $request->get('majorRemodelYear'),
            'tax_value' => $request->get('taxValue'),
            'annual_tax_amount' => $request->get('annualTaxAmount'),
            'neighborhood' => $request->get('neighborhood'),
            'transport' => $request->get('transport'),
            'shopping' =>$request->get('shopping'),
            'school' => $request->get('school'),
            'swimmimg_pool' => $request->get('swimmimgPool'),
            'gym' => $request->get('gym'),
            'city' => $request->get('city'),
            'water' => $request->get('water'),
            'park' => $request->get('park'),
            'concierge' => $request->get('concierge'),
            'image' => $fileNameToStore,
            'thumbnail' => $thumbStore
        ]);

        $property->save();

        return response([

           'property' => $property,
           'message' => 'Property Created Successfully'

            ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            // 'ownerId' => 'sometimes',
            'agentId' => 'required|integer',
            'category' => 'required',
            'address' => 'required',
            'location' => 'required',
            'description' => 'required',
            'type' => 'required',
            'subType' => 'required',
            'homeType' => 'required',
            'status' => 'sometimes',
            'bedroom' => 'required|integer',
            'bathroom' => 'required|integer',
            'halfBedroom' => 'required|integer',
            'quarterBedroom' => 'required|integer',
            'threeQuarterBedroom' => 'required|integer',
            'size' => 'required',
            'mainPrize' => 'required',
            'sizePrize' => 'somethings',
            'estimatePrize' => 'required',
            'yearBuilt' => 'required',
            'heating' => 'required',
            'cooling' => 'required',
            'parking' => 'required',
            'lotSize' => 'required',
            'story' => 'required|integer',
            'internetTv' => 'required',
            'newConstruction' => 'required',
            'majorRemodelYear' => 'required',
            'taxValue' => 'required',
            'annualTaxAmount' => 'required',
            'neighborhood' => 'required',
            'transport' => 'required|boolean',
            'shopping' =>'required|boolean',
            'school' => 'required|boolean',
            'swimmimgPool' => 'required|boolean',
            'gym' => 'required|boolean',
            'city' => 'required|boolean',
            'water' => 'required|boolean',
            'park' => 'required|boolean',
            // 'cordinate' => 'required',
            'image' => 'sometimes|file|image|max:5000',
        ]);


        $property = Property::find($id);

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
            $path = $request->file('image')->storeAs('public/images/propertyImages', $fileNameToStore);
            // Delete file if exists
            Storage::delete('public/images/'.$property->image);

	   //Make thumbnails
	    $thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
            $thumb = Image::make($request->file('image')->getRealPath());
            $thumb->resize(80, 80);
            $thumb->save('storage/images/'.$thumbStore);

        }


        $property->owner_id = auth()->user()->id;
        $property->agent_id = $request->get('agentId');
        $property->category = $request->get('category');
        $property->address = $request->get('category');
        $property->location = $request->get('address');
        $property->description = $request->get('description');
        $property->type = $request->get('type');
        $property->sub_type = $request->get('subType');
        $property->home_type = $request->get('homeType');
        $property->status = $request->get('status');
        $property->bedroom = $request->get('bedroom');
        $property->bathroom = $request->get('bathroom');
        $property->half_bedroom = $request->get('halfBedroom');
        $property->quarter_bedroom = $request->get('quarterBedroom');
        $property->three_quarter_bedroom = $request->get('threeQuarterBedroom');
        $property->size = $request->get('size');
        $property->main_prize = $request->get('mainPrize');
        $property->size_prize = $request->get('sizePrize');
        $property->estimate_prize = $request->get('estimatePrize');
        $property->year_built = $request->get('yearBuilt');
        $property->heating = $request->get('heating');
        $property->cooling = $request->get('cooling');
        $property->parking = $request->get('parking');
        $property->lot_size = $request->get('lotSize');
        $property->story = $request->get('story');
        $property->internet_tv = $request->get('internetTv');
        $property->new_construction = $request->get('newConstruction');
        $property->major_remodel_year = $request->get('majorRemodelYear');
        $property->tax_value = $request->get('taxValue');
        $property->annual_tax_amount = $request->get('annualTaxAmount');
        $property->neighborhood = $request->get('neighborhood');
        $property->transport = $request->get('transport');
        $property->shopping =$request->get('shopping');
        $property->school = $request->get('school');
        $property->swimmimg_pool = $request->get('swimmimgPool');
        $property->gym = $request->get('gym');
        $property->city = $request->get('city');
        $property->water = $request->get('water');
        $property->park = $request->get('park');
        $property->concierge = $request->get('concierge');

        if($request->hasFile('image')){
            $property->image = $fileNameToStore;
            $property->thumbnail = $thumbStore;
        }
        $property->save();

        return response([

            'property' => $property,
            'message' => 'Property Updated Successfully'

             ]);

    }


    // public function search(Request $request){

    //         $propertyResult = Property::where('location', 'LIKE', "%$request->get('cooling')%")
    //         ->orWhere('category', 'LIKE', "%$request->get('propertyType')%")
    //         ->orWhere('description', 'LIKE', "%$request->get('keywords')%")
    //         ->orWhere('school', 'LIKE', "%$request->get('schools')%")
    //         ->orWhere('size', 'LIKE', "%$request->get('minPropertySizes')%")
    //         ->orWhere('size', 'LIKE', "%$request->get('maxPropertySizes')%")
    //         ->orWhere('main_prize', 'LIKE', "%$request->get('minPrize')%")
    //         ->orWhere('main_prize', 'LIKE', "%$request->get('maxPrize')%")
    //         ->orWhere('lot_size', 'LIKE', "%$request->get('minCarSpaces')%")
    //         ->orWhere('lot_size', 'LIKE', "%$request->get('maxCarSpaces')%")
    //         ->orWhere('bathroom', 'LIKE', "%$request->get('minBathrooms')%")
    //         ->orWhere('bathroom', 'LIKE', "%$request->get('maxBathrooms')%")
    //         ->orWhere('bedroom', 'LIKE', "%$request->get('maxBedrooms')%")
    //         ->orWhere('bedroom', 'LIKE', "%$request->get('minBedrooms')%")
    //         ->orWhere('three_quarter_bedroom', 'LIKE', "%$request->get('minBedrooms')%")
    //         ->orWhere('transport', 'LIKE', "%$request->get('transport')%")
    //         ->orWhere('shopping', 'LIKE', "%$request->get('shooping')%")
    //         ->orWhere('swimmimg_pool', 'LIKE', "%$request->get('swimmingPool')%")
    //         ->orWhere('gym', 'LIKE', "%$request->get('gym')%")->get();

        // dd($propertyResult);

        // return response([ 'propertyResult' => PropertyResource::collection($propertyResult), 'message' => 'Retrieved successfully'], 200);

    //     if ($search = \Request::get('q')){
    //         $propertyResult = Property::where(function($query) use ($search){
    //         $query->where('location', 'LIKE', "%$search%")
    //         ->orWhere('type', 'LIKE', "%$search%")
    //         ->orWhere('size', 'LIKE', "%$search%")
    //         ->orWhere('main_prize', 'LIKE', "%$search%")
    //         ->orWhere('lot_size', 'LIKE', "%$search%")
    //         ->orWhere('size_prize', 'LIKE', "%$search%")
    //         ->orWhere('bathroom', 'LIKE', "%$search%")
    //         ->orWhere('bedroom', 'LIKE', "%$search%")
    //         ->orWhere('three_quarter_bedroom', 'LIKE', "%$search%")
    //         ->orWhere('estimate_prize', 'LIKE', "%$search%")
    //         ->orWhere('transport', 'LIKE', "%$search%")
    //         ->orWhere('shopping', 'LIKE', "%$search%")
    //         ->orWhere('swimmimg_pool', 'LIKE', "%$search%")
    //         ->orWhere('gym', 'LIKE', "%$search%")
    //         ->orWhere('city', 'LIKE', "%$search%")
    //         ->orWhere('water', 'LIKE', "%$search%")
    //         ->orWhere('park', 'LIKE', "%$search%");

    //     });
    // }

        // return $propertyResult;
        // return response([ 'propertyResult' => PropertyResource::collection($propertyResult), 'message' => 'Retrieved successfully'], 200);
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $property = Property::findOrFail($id);

        //Check if property exists before deleting
        if (!isset($property)){
            return redirect('/propertys')->with('error', 'No property Found');
        }

        // Check for correct user
        if(auth()->user()->id !==$property->owner_id){
            return response(['message' => 'Unauthorized User']);
        }

        if($property->image != 'noimage.jpg'){
            // Delete Image
            Storage::delete('public/images/propertyImages/'.$property->image);
            Storage::delete('storage/images/'.$property->thumbnail);
        }

        $property->delete();
        // $property->property_images()->delete();
        // $property->delete();
        return response([
            'message' => 'Property Deleted Successfully'
        ]);
    }


}
