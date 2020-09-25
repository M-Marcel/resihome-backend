<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Property;
use Illuminate\Http\Request;
use App\Http\Resources\PropertyResource;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ForSalePropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::where('category', 'Home for sale')->get();
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
            'mountain' => 'required|boolean',
            // 'concierge' => 'required',
            'image' => 'file|image|max:5000',

        ]);


        // Handle File Upload
        if($request->hasFile('image')){
             //get filename with extension
            $filenamewithextension = $request->file('image')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('image')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
            //Upload File to s3
            Storage::disk('s3')->put($filenametostore, fopen($request->file('image'), 'r+'), 'public');
            $imageUrl = 'https://'. env('AWS_BUCKET') .'.s3.'. env('AWS_DEFAULT_REGION') . '.amazonaws.com/'. $filenametostore;
        }

        $property = new Property([
            'owner_id' => auth()->user()->id,
            'agent_id' => $request->get('agentId'),
            'category' => $request->get('category'),
            'address' => $request->get('address'),
            'location' => $request->get('location'),
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
            'mountain' => $request->get('mountain'),
            'concierge' => $request->get('concierge'),
            'imageUrl' => $imageUrl,
            'image' => $filenametostore,
            // 'thumbnail' => $thumbStore
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
            'mountain' => 'required|boolean',
            // 'cordinate' => 'required',
            'image' => 'file|image|max:5000',

        ]);


        $property = Property::find($id);

        if($request->hasFile('image')){
            //get filename with extension
           $filenamewithextension = $request->file('image')->getClientOriginalName();

           //get filename without extension
           $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

           //get file extension
           $extension = $request->file('image')->getClientOriginalExtension();

           //filename to store
           $filenametostore = $filename.'_'.time().'.'.$extension;

           if ($property->image !== null){
            Storage::disk('s3')->delete($property->image);
            }
           //Upload File to s3
           Storage::disk('s3')->put($filenametostore, fopen($request->file('image'), 'r+'), 'public');
           $imageUrl = 'https://'. env('AWS_BUCKET') .'.s3.'. env('AWS_DEFAULT_REGION') . '.amazonaws.com/'. $filenametostore;
       }



        $property->owner_id = auth()->user()->id;
        $property->agent_id = $request->get('agentId');
        $property->category = $request->get('category');
        $property->address = $request->get('address');
        $property->location = $request->get('location');
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
        $property->mountain = $request->get('mountain');
        $property->concierge = $request->get('concierge');

        if($request->hasFile('image')){
            $property->image = $filenametostore;
            $property->imageUrl = $imageUrl;
            // $property->thumbnail = $thumbStore;
        }
        $property->save();

        return response([

            'property' => $property,
            'message' => 'Property Updated Successfully'

             ]);
    // return response()->json($request->all());

    }



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
            return response(['message' => 'No property Found']);
        }

        // Check for correct user
        if(auth()->user()->id !==$property->owner_id){
            return response(['message' => 'Unauthorized User']);
        }

        if($property->image != null){
            // Delete Image
            Storage::disk('s3')->delete($property->image);
        }

        $property->delete();
        return response([
            'message' => 'Property Deleted Successfully'
        ]);
    }


}
