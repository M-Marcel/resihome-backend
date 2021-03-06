<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PropertyResource;
use App\Http\Resources\Property2Resource;
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

    public function leased()
    {
        // $properties = Property::where('status', 0)
        $properties = Property::where('category', 'Long term lease')
        // ->orWhere('category', 'Short term lease')
        ->whereStatus(0)
        ->get();

        $properties2 = Property::where('category', 'Short term lease')
        // ->orWhere('category', 'Short term lease')
        ->whereStatus(0)
        ->get();

        return response([

            'Long Lease property' => $properties,
            'Short Lease property' => $properties2,
            'message' => 'Retrieved successfully'

             ]);

        // $properties = Property::where('category', 'Long term lease')

        // return response([ 'properties' => Property2Resource::collection($properties, $properties2), 'message' => 'Retrieved successfully'], 206);
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

    public function fetchAddress()
    {
        // $address = DB::table('property')->pluck('address');
        $address = DB::table('property')->pluck('location');


        return response([

            'address' => $address,
            'message' => 'Property address retrived successfully'

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


            if (!empty($request->category)) {
                $property = $property->where('category', 'like', '%'.$request->category.'%');
            }

            if (!empty($request->transports)) {
                $property = $property->where('transport', $request->transports);
            }
            // if (!empty($request->propertyType)) {
            //     $prop = $request->propertyType;
            //     foreach ($prop as $propType) {
            //         $property = $property->where('propertyType', $propType);
            //     }

            // }
            // if (!empty($request->ownerId)) {
            //     $property = $property->where('owner_id', $request->ownerId);
            // }

            if (!empty($request->shoppings)) {
                $property = $property->where('shopping', $request->shoppings);
            }

            if (!empty($request->swimmingPool)) {
                $property = $property->where('swimmimg_pool', $request->swimmingPool);
            }

            if (!empty($request->gym)) {
                $property = $property->where('gym', $request->gym);
            }

            if (!empty($request->schools)) {
                $property = $property->where('school', $request->schools);
            }

            if (!empty($request->concierge)) {
                $property = $property->where('concierge', $request->concierge);
            }

            if (!empty($request->location)) {
                $property = $property->where('location', 'like', '%'.$request->location.'%');
            }

            if (!empty($request->propertyType)) {
                $property = $property->where('type', $request->propertyType);
            }




            if (!empty($request->minPrize)) {
                $property = $property->where('main_prize', '>=', '%'.$request->minPrize.'%');
            }

            if (!empty($request->maxPrize)) {
                $property = $property->where('main_prize', '<=', '%'.$request->maxPrize.'%');
            }

            if (!empty($request->minPropertySizes)) {
                $property = $property->where('size', '>=', '%'.$request->minPropertySizes.'%');
            }

            // // if (!empty($request->maxPropertySizes)) {
            // //     $property = $property->where('size', '<=', '%'.$request->maxPropertySizes.'%');
            // // }

            if (!empty($request->minCarSpaces)) {
                $property = $property->where('lot_size', '>=', '%'.$request->minCarSpaces.'%');
            }

            // // if (!empty($request->maxCarSpaces)) {
            // //     $property = $property->where('lot_size', '<=', '%'.$request->maxCarSpaces.'%');
            // // }

            if (!empty($request->minBathrooms)) {
                $property = $property->where('bathroom', '>=', '%'.$request->minBathrooms.'%');
            }

            // if (!empty($request->minBathrooms)) {
            //     $property = $property->where('bathroom', '>=', '%'.$request->minBathrooms.'%');
            // }

            if (!empty($request->keywords)) {
                $property = $property->where('description', 'like', '%'.$request->keywords.'%');
            }

            // $properties = $property->get();
            // return $properties;

        // return response([
        //     'Properties' => $properties,
        //     'message' => 'Search Done'
        //     ]);

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

        $properties = $property->get();
        return response($properties);
    }

    public function mainSearch(Request $request){

        $property = Property::query();


            if (!empty($request->address)) {
                $property = $property->where('address', 'like', '%'.$request->address.'%');
            }

            // if (!empty($request->propertyType)) {
            //     $property = $property->where('type', $request->propertyType);
            // }

            // if (!empty($request->availableDate)) {
            //     $property = $property->where('available_date', $request->availableDate);
            // }

            if (!empty($request->minPrize)) {
                $property = $property->where('main_prize', '>=', '%'.$request->minPrize.'%');
            }

            if (!empty($request->maxPrize)) {
                $property = $property->where('main_prize', '<=', '%'.$request->maxPrize.'%');
            }


            if (!empty($request->minBedrooms)) {
                $property = $property->where('bedroom', '>=', '%'.$request->minBathrooms.'%');
            }

            if (!empty($request->maxBedrooms)) {
                $property = $property->where('bedroom', '<=', '%'.$request->maxBathrooms.'%');
            }

            // if (!empty($request->keywords)) {
            //     $property = $property->where('description', 'like', '%'.$request->keywords.'%');
            // }

        $properties = $property->get();
        return response($properties);
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
