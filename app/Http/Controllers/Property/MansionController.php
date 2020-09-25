<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Mansion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MansionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mansion = Mansion::all();
        return response([

            'Mansion' => $mansion,
            'message' => 'Mansion Loaded Successfully'

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
        $this->validate($request, [
            // 'ownerId' => 'sometimes',
            'agentId' => 'required|integer',
            'title' => 'required',
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

        $mansion = new Mansion([
            'owner_id' => auth()->user()->id,
            'agent_id' => $request->get('agentId'),
            'title' => $request->get('title'),
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
            'video' => $request->get('video'),
            'video_description' => $request->get('videoDescription')
            // 'thumbnail' => $thumbStore
        ]);

        $mansion->save();

        return response([

           'Mansion' => $mansion,
           'message' => 'Mansion Created Successfully'

            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mansion  $mansion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mansion = Mansion::where('id', $id)->get();

        return response([
            'Mansion' => $mansion,
            'message' => 'Mansion Retrieved successfully'
             ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mansion  $mansion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            // 'ownerId' => 'sometimes',
            'agentId' => 'required|integer',
            'title' => 'required',
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
            'image' => 'file|image|max:5000',

        ]);

        $mansion = Mansion::find($id);

        if($request->hasFile('image')){
            //get filename with extension
           $filenamewithextension = $request->file('image')->getClientOriginalName();

           //get filename without extension
           $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

           //get file extension
           $extension = $request->file('image')->getClientOriginalExtension();

           //filename to store
           $filenametostore = $filename.'_'.time().'.'.$extension;

           if ($mansion->image !== null){
            Storage::disk('s3')->delete($mansion->image);
            }
           //Upload File to s3
           Storage::disk('s3')->put($filenametostore, fopen($request->file('image'), 'r+'), 'public');
           $imageUrl = 'https://'. env('AWS_BUCKET') .'.s3.'. env('AWS_DEFAULT_REGION') . '.amazonaws.com/'. $filenametostore;
       }

       $mansion->owner_id = auth()->user()->id;
        $mansion->agent_id = $request->get('agentId');
        $mansion->title = $request->get('title');
        $mansion->address = $request->get('address');
        $mansion->location = $request->get('location');
        $mansion->description = $request->get('description');
        $mansion->type = $request->get('type');
        $mansion->sub_type = $request->get('subType');
        $mansion->home_type = $request->get('homeType');
        $mansion->status = $request->get('status');
        $mansion->bedroom = $request->get('bedroom');
        $mansion->bathroom = $request->get('bathroom');
        $mansion->half_bedroom = $request->get('halfBedroom');
        $mansion->quarter_bedroom = $request->get('quarterBedroom');
        $mansion->three_quarter_bedroom = $request->get('threeQuarterBedroom');
        $mansion->size = $request->get('size');
        $mansion->main_prize = $request->get('mainPrize');
        $mansion->size_prize = $request->get('sizePrize');
        $mansion->estimate_prize = $request->get('estimatePrize');
        $mansion->year_built = $request->get('yearBuilt');
        $mansion->heating = $request->get('heating');
        $mansion->cooling = $request->get('cooling');
        $mansion->parking = $request->get('parking');
        $mansion->lot_size = $request->get('lotSize');
        $mansion->story = $request->get('story');
        $mansion->internet_tv = $request->get('internetTv');
        $mansion->new_construction = $request->get('newConstruction');
        $mansion->major_remodel_year = $request->get('majorRemodelYear');
        $mansion->tax_value = $request->get('taxValue');
        $mansion->annual_tax_amount = $request->get('annualTaxAmount');
        $mansion->neighborhood = $request->get('neighborhood');
        $mansion->transport = $request->get('transport');
        $mansion->shopping =$request->get('shopping');
        $mansion->school = $request->get('school');
        $mansion->swimmimg_pool = $request->get('swimmimgPool');
        $mansion->gym = $request->get('gym');
        $mansion->city = $request->get('city');
        $mansion->water = $request->get('water');
        $mansion->mountain = $request->get('mountain');
        $mansion->park = $request->get('park');
        $mansion->concierge = $request->get('concierge');

        if($request->hasFile('image')){
            $mansion->image = $filenametostore;
            $mansion->imageUrl = $imageUrl;
            // $mansion->thumbnail = $thumbStore;
        }

        if($request->hasFile('video')){
            $mansion->video = $request->get('video');
            $mansion->video_description = $request->get('videoDescription');
            // $mansion->thumbnail = $thumbStore;
        }
        $mansion->save();

        return response([

            'Mansion' => $mansion,
            'message' => 'Mansion Updated Successfully'

             ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mansion  $mansion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mansion = Mansion::findOrFail($id);

        //Check if property exists before deleting
        if (!isset($mansion)){
            return response(['message' => 'No mansion Found']);
        }

        // Check for correct user
        if(auth()->user()->id !==$mansion->owner_id){
            return response(['message' => 'Unauthorized User']);
        }

        if($mansion->image != null){
            // Delete Image
            Storage::disk('s3')->delete($mansion->image);
        }

        $mansion->delete();
        return response([
            'message' => 'Mansion Deleted Successfully'
        ]);
    }
}
