<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Property;
use Illuminate\Http\Request;
use App\Http\Resources\PropertyResource;
use Intervention\Image\Facades\Image;

$propertyType = 'For sale by owner';

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
        return response([ 'properties' => PropertyResource::collection($properties), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $userId = $user->id;

        $request->validate([
            'ownerId' => 'sometimes',
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
            'cordinate' => 'required',
            'image' => 'sometimes|file|image|max:5000',

        ]);

        $property = new Property([
            'owner_id' => $user->id,
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
            'cordinate' => $request->get('cordinate'),
        ]);
        $property->save();
        // $property = factory(\App\Property::class)->create();
        // $property->property_images()->create([
        //     'original' => 'originalImage.png',
        // ]);
        // dd($property->property_images);

        if (request()->has('image')){
            $property->property_images()->create([
                'original' => request()->image->store('propertyImages', 'public'),
            ]);
        }

        $image = Image::make(public_path('storage/ '. $property->property_images))->fit(300, 300);
        $image->save();

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
        $user = auth()->user();
        $userId = $user->id;

        $request->validate([
            'ownerId' => 'sometimes',
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
            'cordinate' => 'required',
            'image' => 'sometimes|file|image|max:5000',
        ]);

        $property = Property::find($id);
        $property->owner_id = $user->id;
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
        $property->cordinate = $request->get('cordinate');

        $property->save();
        $property->property_images()->original = $request->get('image');

        $property->push();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        //
    }
}
