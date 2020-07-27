<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Property;
use App\Property_image;
use Illuminate\Http\Request;
use App\Http\Resources\PropertyResource;
use App\Http\Resources\PropertyImageResource;
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
        $properties = Property::where('category', 'Home for sale')->get();
        // $properties = Property::where('category', 'For sale by owner')->get();
        dd($properties[]['id']);
        // $propertyArray = PropertyResource::collection($properties);
        // dd($propertyArray[]);

        foreach ($properties as $id) {
            // dd($id['id']);
            $iid = $id['id'];
            $propertyImage = Property_image::where('property_id', 71)->get();
            dd($propertyImage);
        //    return PropertyImageResource::collection($propertyImage);
        };

        // return response([
        //     'properties' => PropertyResource::collection($properties),
        //     'image' => PropertyImageResource::collection($propertyImage),
        //     'message' => 'Retrieved successfully'
        // ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    // public function store(Request $request)
    {
        // $user = auth()->user();
        // $userId = $user->id;

        // $request->validate([
        //     'ownerId' => 'sometimes',
        //     'agentId' => 'required|integer',
        //     'category' => 'required',
        //     'address' => 'required',
        //     'location' => 'required',
        //     'description' => 'required',
        //     'type' => 'required',
        //     'subType' => 'required',
        //     'homeType' => 'required',
        //     'status' => 'sometimes',
        //     'bedroom' => 'required|integer',
        //     'bathroom' => 'required|integer',
        //     'halfBedroom' => 'required|integer',
        //     'quarterBedroom' => 'required|integer',
        //     'threeQuarterBedroom' => 'required|integer',
        //     'size' => 'required',
        //     'mainPrize' => 'required',
        //     'sizePrize' => 'somethings',
        //     'estimatePrize' => 'required',
        //     'yearBuilt' => 'required',
        //     'heating' => 'required',
        //     'cooling' => 'required',
        //     'parking' => 'required',
        //     'lotSize' => 'required',
        //     'story' => 'required|integer',
        //     'internetTv' => 'required',
        //     'newConstruction' => 'required',
        //     'majorRemodelYear' => 'required',
        //     'taxValue' => 'required',
        //     'annualTaxAmount' => 'required',
        //     'neighborhood' => 'required',
        //     'transport' => 'required|boolean',
        //     'shopping' =>'required|boolean',
        //     'school' => 'required|boolean',
        //     'swimmimgPool' => 'required|boolean',
        //     'gym' => 'required|boolean',
        //     'city' => 'required|boolean',
        //     'water' => 'required|boolean',
        //     'park' => 'required|boolean',
        //     'cordinate' => 'required',
        //     'image' => 'sometimes|file|image|max:5000',

        // ]);

        $property = new Property([
            // 'owner_id' => $user->id,
            // 'agent_id' => $request->get('agentId'),
            // 'category' => $request->get('category'),
            // 'address' => $request->get('category'),
            // 'location' => $request->get('address'),
            // 'description' => $request->get('description'),
            // 'type' => $request->get('type'),
            // 'sub_type' => $request->get('subType'),
            // 'home_type' => $request->get('homeType'),
            // 'status' => $request->get('status'),
            // 'bedroom' => $request->get('bedroom'),
            // 'bathroom' => $request->get('bathroom'),
            // 'half_bedroom' => $request->get('halfBedroom'),
            // 'quarter_bedroom' => $request->get('quarterBedroom'),
            // 'three_quarter_bedroom' => $request->get('threeQuarterBedroom'),
            // 'size' => $request->get('size'),
            // 'main_prize' => $request->get('mainPrize'),
            // 'size_prize' => $request->get('sizePrize'),
            // 'estimate_prize' => $request->get('estimatePrize'),
            // 'year_built' => $request->get('yearBuilt'),
            // 'heating' => $request->get('heating'),
            // 'cooling' => $request->get('cooling'),
            // 'parking' => $request->get('parking'),
            // 'lot_size' => $request->get('lotSize'),
            // 'story' => $request->get('story'),
            // 'internet_tv' => $request->get('internetTv'),
            // 'new_construction' => $request->get('newConstruction'),
            // 'major_remodel_year' => $request->get('majorRemodelYear'),
            // 'tax_value' => $request->get('taxValue'),
            // 'annual_tax_amount' => $request->get('annualTaxAmount'),
            // 'neighborhood' => $request->get('neighborhood'),
            // 'transport' => $request->get('transport'),
            // 'shopping' =>$request->get('shopping'),
            // 'school' => $request->get('school'),
            // 'swimmimg_pool' => $request->get('swimmimgPool'),
            // 'gym' => $request->get('gym'),
            // 'city' => $request->get('city'),
            // 'water' => $request->get('water'),
            // 'park' => $request->get('park'),
            // 'cordinate' => $request->get('cordinate'),


            'agent_id' => 1,
            'category' => 'Home for sale',
            'address' => '986 Littel Terrace Haagbury, NY 79473-4501',
            'location' => 'New york',
            'description' => 'Sunt consequatur saepe sit. Et cum reprehenderit soluta omnis nulla. Aut impedit magnam libero commodi.s',
            'type' => 'Single Family',
            'sub_type' => 'other',
            'home_type' => 'other',
            'status' => 1,
            'bedroom' =>4,
            'bathroom' =>4,
            'half_bedroom' =>2,
            'quarter_bedroom' =>1,
            'three_quarter_bedroom' =>1,
            'size' =>'9000',
            'main_prize' =>'6300000',
            'estimate_prize' =>'7000000',
            'year_built' => '2019',
            'heating' => 'Other',
            'cooling' => 'Other',
            'parking' => '2',
            'lot_size' => '1.5',
            'story' => 1,
            'internet_tv' => 'Other',
            'new_construction' => 'Other',
            'major_remodel_year' => 'Other',
            'tax_value' => '320900',
            'annual_tax_amount' => '920900',
            'neighborhood' =>'other',
            'transport' =>1,
            'shopping' =>1,
            'school' =>1,
            'swimmimg_pool' => 1,
            'gym' => 1,
            'city' => 1,
            'water' => 1,
            'park' => 1,
            'cordinate' => '12 LAT 1.4 NW',
            'cordinate' => '12 LAT 1.4 NW',
        ]);

        $property->save();
        // $property = factory(\App\Property::class)->create();
        // $property->property_images()->create([
        //     'original' => 'originalImage.png',
        // ]);
        // dd($property->property_images);


            $property->property_images()->create([
                'original' => 'MainImage.png',
            ]);

        // if (request()->has('image')){
        //     $property->property_images()->create([
        //         'original' => request()->image->store('propertyImages', 'public'),
        //     ]);
        // }

        // $image = Image::make(public_path('storage/ '. $property->property_images))->fit(300, 300);
        // $image->save();

        // dd($property);

        // dd($property->property_images);

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
    public function update()
    // public function update(Request $request, $id)
    {
        $id = 69;
        // $user = auth()->user();
        // $userId = $user->id;

        // $request->validate([
        //     'ownerId' => 'sometimes',
        //     'agentId' => 'required|integer',
        //     'category' => 'required',
        //     'address' => 'required',
        //     'location' => 'required',
        //     'description' => 'required',
        //     'type' => 'required',
        //     'subType' => 'required',
        //     'homeType' => 'required',
        //     'status' => 'sometimes',
        //     'bedroom' => 'required|integer',
        //     'bathroom' => 'required|integer',
        //     'halfBedroom' => 'required|integer',
        //     'quarterBedroom' => 'required|integer',
        //     'threeQuarterBedroom' => 'required|integer',
        //     'size' => 'required',
        //     'mainPrize' => 'required',
        //     'sizePrize' => 'somethings',
        //     'estimatePrize' => 'required',
        //     'yearBuilt' => 'required',
        //     'heating' => 'required',
        //     'cooling' => 'required',
        //     'parking' => 'required',
        //     'lotSize' => 'required',
        //     'story' => 'required|integer',
        //     'internetTv' => 'required',
        //     'newConstruction' => 'required',
        //     'majorRemodelYear' => 'required',
        //     'taxValue' => 'required',
        //     'annualTaxAmount' => 'required',
        //     'neighborhood' => 'required',
        //     'transport' => 'required|boolean',
        //     'shopping' =>'required|boolean',
        //     'school' => 'required|boolean',
        //     'swimmimgPool' => 'required|boolean',
        //     'gym' => 'required|boolean',
        //     'city' => 'required|boolean',
        //     'water' => 'required|boolean',
        //     'park' => 'required|boolean',
        //     'cordinate' => 'required',
        //     'image' => 'sometimes|file|image|max:5000',
        // ]);

        $property = Property::find($id);
        $property->owner_id = 1;
        $property->agent_id = 1;
        $property->category = 'Home for sale';
        $property->address = '986 Littel Terrace Haagbury, NY 79473-4501';
        $property->location = 'New york';
        $property->description = 'Sunt consequatur saepe sit. Et cum reprehenderit soluta omnis nulla. Aut impedit magnam libero commodi.s';
        $property->type = 'Single Family';
        $property->sub_type = 'other';
        $property->home_type = 'other';
        $property->status = 1;
        $property->bedroom = 4;
        $property->bathroom = 4;
        $property->half_bedroom = 4 ;
        $property->quarter_bedroom = 4;
        $property->three_quarter_bedroom = 4;
        $property->size = '9000';
        $property->main_prize = '6300000';
        $property->size_prize = '7000000';
        $property->estimate_prize = '600000';
        $property->year_built = '2019';
        $property->heating = 'Other';
        $property->cooling = 'Other';
        $property->parking = '2';
        $property->lot_size = '1.5';
        $property->story = 1;
        $property->internet_tv ='Other';
        $property->new_construction = 'Other';
        $property->major_remodel_year = 'Other';
        $property->tax_value = '320900';
        $property->annual_tax_amount = '920900';
        $property->neighborhood = 'other';
        $property->transport = 1;
        $property->shopping = 1;
        $property->school = 1;
        $property->swimmimg_pool = 1;
        $property->gym = 1;
        $property->city = 1;
        $property->water = 1;
        $property->park = 1;
        $property->cordinate = '12 LAT 1.4 NW';




        // $property = Property::find($id);
        // $property->owner_id = $user->id;
        // $property->agent_id = $request->get('agentId');
        // $property->category = $request->get('category');
        // $property->address = $request->get('category');
        // $property->location = $request->get('address');
        // $property->description = $request->get('description');
        // $property->type = $request->get('type');
        // $property->sub_type = $request->get('subType');
        // $property->home_type = $request->get('homeType');
        // $property->status = $request->get('status');
        // $property->bedroom = $request->get('bedroom');
        // $property->bathroom = $request->get('bathroom');
        // $property->half_bedroom = $request->get('halfBedroom');
        // $property->quarter_bedroom = $request->get('quarterBedroom');
        // $property->three_quarter_bedroom = $request->get('threeQuarterBedroom');
        // $property->size = $request->get('size');
        // $property->main_prize = $request->get('mainPrize');
        // $property->size_prize = $request->get('sizePrize');
        // $property->estimate_prize = $request->get('estimatePrize');
        // $property->year_built = $request->get('yearBuilt');
        // $property->heating = $request->get('heating');
        // $property->cooling = $request->get('cooling');
        // $property->parking = $request->get('parking');
        // $property->lot_size = $request->get('lotSize');
        // $property->story = $request->get('story');
        // $property->internet_tv = $request->get('internetTv');
        // $property->new_construction = $request->get('newConstruction');
        // $property->major_remodel_year = $request->get('majorRemodelYear');
        // $property->tax_value = $request->get('taxValue');
        // $property->annual_tax_amount = $request->get('annualTaxAmount');
        // $property->neighborhood = $request->get('neighborhood');
        // $property->transport = $request->get('transport');
        // $property->shopping =$request->get('shopping');
        // $property->school = $request->get('school');
        // $property->swimmimg_pool = $request->get('swimmimgPool');
        // $property->gym = $request->get('gym');
        // $property->city = $request->get('city');
        // $property->water = $request->get('water');
        // $property->park = $request->get('park');
        // $property->cordinate = $request->get('cordinate');



        $property->save();
        $property->property_images->original = 'NewImage.png';

        $property->push();
        // dd($property);

        dd($property->property_images);

    }


    public function search(Request $request){

            $propertyResult = Property::where('cooling', 'LIKE', "%$request->get('cooling')%")->get();
            // ->orWhere('school', 'LIKE', "%$request->get('school')%")
            // ->orWhere('size', 'LIKE', "%$request->get('location')%")
            // ->orWhere('main_prize', 'LIKE', "%$request->get('location')%")
            // ->orWhere('lot_size', 'LIKE', "%$request->get('location')%")
            // ->orWhere('size_prize', 'LIKE', "%$request->get('location')%")
            // ->orWhere('bathroom', 'LIKE', "%$request->get('location')%")
            // ->orWhere('bedroom', 'LIKE', "%$request->get('location')%")
            // ->orWhere('three_quarter_bedroom', 'LIKE', "%$request->get('location')%")
            // ->orWhere('estimate_prize', 'LIKE', "%$request->get('location')%")
            // ->orWhere('transport', 'LIKE', "%$request->get('location')%")
            // ->orWhere('shopping', 'LIKE', "%$request->get('location')%")
            // ->orWhere('swimmimg_pool', 'LIKE', "%$request->get('location')%")
            // ->orWhere('gym', 'LIKE', "%$request->get('location')%")
            // ->orWhere('city', 'LIKE', "%$request->get('location')%")
            // ->orWhere('water', 'LIKE', "%$request->get('location')%")
            // ->orWhere('park', 'LIKE', "%$request->get('location')%")->get();

        // dd($propertyResult);

        return response([ 'propertyResult' => PropertyResource::collection($propertyResult), 'message' => 'Retrieved successfully'], 200);

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
        $property->property_images()->delete();
        $property->delete();
    }


}
