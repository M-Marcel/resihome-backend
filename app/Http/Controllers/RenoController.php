<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RenoController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    public function renoSearch(Request $request){

        $reno = User::query();


            if (!empty($request->location)) {
                $reno = $reno->where('user_role', 5);
            }

            if (!empty($request->location)) {
                $reno = $reno->where('address', 'like', '%'.$request->location.'%');
            }

            if (!empty($request->location)) {
                $reno = $reno->where('city', 'like', '%'.$request->location.'%');
            }
            if (!empty($request->location)) {
                $reno = $reno->where('state', 'like', '%'.$request->location.'%');
            }
            if (!empty($request->location)) {
                $reno = $reno->where('country', 'like', '%'.$request->location.'%');
            }
            if (!empty($request->location)) {
                $reno = $reno->where('company_address', 'like', '%'.$request->location.'%');
            }
            if (!empty($request->name)) {
                $reno = $reno->where('firstname', 'like', '%'.$request->name.'%');
            }
            if (!empty($request->name)) {
                $reno = $reno->where('lastname', 'like', '%'.$request->name.'%');
            }


        $reno = $reno->get();
        return response($reno);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
