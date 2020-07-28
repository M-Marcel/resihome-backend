<?php

namespace App\Http\Controllers\Property;
use App\Property;
use App\User;
use App\PropertyUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PropertyUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(auth()->user()->id);
        // foreach (auth()->user()->id as $id) {

        //     $property = Property::where('id', $id)->get();
        // }
        return response($user->properties);
    }

    public function save($id){
        $user = User::find(auth()->user()->id);
        $user->properties()->syncWithoutDetaching([$id]);
// dd($user->properties->where('property_id', $id)->pivot);
        $test = PropertyUser::where('property_id', $id)
        ->where('user_id', auth()->user()->id)->get('created_at');

        // dd($test);
        return response(
            [
               'property' => Property::find($id),
               'saved at' => $test
            ]
        );
    }

    public function removeSaved($id){
        $user = User::find(auth()->user()->id);
        $user->properties()->detach([$id]);

        return response(Property::find($id));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
