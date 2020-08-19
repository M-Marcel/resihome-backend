<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PropertyResource;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::where('owner_id', Auth::user()->id)->get();
        return response([ 'properties' => PropertyResource::collection($properties), 'message' => 'User Properties Retrieved successfully'], 200);
    }

    public function test()
    {
        $properties = Property::where('category', 'For sale by owner')->get();
        return response([ 'properties' => PropertyResource::collection($properties), 'message' => 'Retrieved successfully'], 206);
    }

    public function sold()
    {
        $properties = Property::where('status', 0)->get();
        return response([ 'properties' => PropertyResource::collection($properties), 'message' => 'Retrieved successfully'], 206);
    }

    public function isSold($id)
    {
        $property = Property::find($id);
        $property->status = 0;
        $property->save();

        return response([

            'property' => $property,
            'message' => 'Property Updated to Sold'

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $property = Property::where('id', $id)->get();
        return response([ 'property' => $property, 'message' => 'Property Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        //
    }
    public function search(Request $request){

        $property = Property::query();
        // $properties = DB::table('property')
        //     ->where('description', 'like', '%'.$request->keywords.'%')
        //     ->where('school', 'like', "%$request->schools%")
        //     ->where('size', '<=', "%$request->minPropertySizes%")
        //     ->where('main_prize', '<=', "%$request->minPrize%")
        //     ->where('main_prize', '>=', "%$request->maxPrize%")
        //     ->where('lot_size', '<=', "%$request->minCarSpaces%")
        //     ->where('lot_size', '>=', "%$request->maxCarSpaces%")
        //     ->where('bathroom', '<=', "%$request->minBathrooms%")
        //     ->where('bathroom', '>=', '%'.$request->maxBedrooms.'%')
        //     ->where('transport', 'like', "%$request->transport%")
        //     ->where('shopping', 'like', "%$request->shooping%")
        //     ->where('swimmimg_pool', 'like', "%$request->swimmingPool%")
        //     ->where('gym', 'like', "%$request->gym%")
        //     ->where('category', 'like', '%'.$request->propertyType.'%')->get();


            // if (!empty($request->propertyType)) {
            //     $property = $property->where('category', 'like', '%'.$request->propertyType.'%');
            // }

            // if (!empty($request->gym)) {
            //     $property = $property->where('gym', 'like', '%'.$request->gym.'%');
            // }

            if (!empty($request->location)) {
                $property = $property->where('location', 'like', '%'.$request->location.'%');
            }

            // if (!empty($request->schools)) {
            //     $property = $property->where('school', 'like', '%'.$request->schools.'%');
            // }

            // if (!empty($minPrize)) {
            //     $property = $property->where('main_prize', '<=', '%'.$minPrize.'%');
            // }

            // if (!empty($maxPrize)) {
            //     $property = $property->where('main_prize', '>=', '%'.$maxPrize.'%');
            // }

            // if (!empty($minPropertySizes)) {
            //     $property = $property->where('size', '<=', '%'.$minPropertySizes.'%');
            // }

            // if (!empty($maxPropertySizes)) {
            //     $property = $property->where('size', '>=', '%'.$maxPropertySizes.'%');
            // }

            // if (!empty($minCarSpaces)) {
            //     $property = $property->where('lot_size', '<=', '%'.$minCarSpaces.'%');
            // }

            // if (!empty($maxCarSpaces)) {
            //     $property = $property->where('lot_size', '>=', '%'.$maxCarSpaces.'%');
            // }

            // if (!empty($minBathrooms)) {
            //     $property = $property->where('bathroom', '<=', '%'.$minBathrooms.'%');
            // }

            // if (!empty($maxBathrooms)) {
            //     $property = $property->where('bathroom', '>=', '%'.$maxBathrooms.'%');
            // }

            // if (!empty($transports)) {
            //     $property = $property->where('transport', '>=', '%'.$transports.'%');
            // }

            // if (!empty($shoppings)) {
            //     $property = $property->where('shopping', '>=', '%'.$shoppings.'%');
            // }

            // if (!empty($swimmingPool)) {
            //     $property = $property->where('swimmimg_pool', '>=', '%'.$swimmingPool.'%');
            // }

            $properties = $property->get();


        return response([
            'Properties' => $properties,
            'message' => 'Search Done'
            ]);

            // dd($properties);
        // $properties = DB::table('property')
        //     ->where('votes', '>', 100)
        //     ->orWhere(function($query) {
        //         $query->where('name', 'Abigail')
        //               ->where('votes', '>', 50);
        //     })
        //     ->get();

    //         $users = DB::table('users')->where([
    //             ['status', '=', '1'],
    //             ['subscribed', '<>', '1'],
    //         ])->get();

    //         $users = DB::table('users')
    //             ->where('votes', '>=', 100)
    //             ->get();

    //         $users = DB::table('users')
    //                         ->where('votes', '<>', 100)
    //                         ->get();

    //         $users = DB::table('users')
    //                         ->where('name', 'like', 'T%')
    //                         ->get();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return response(['message' => 'Property Deleted successfully']);
    }
}
