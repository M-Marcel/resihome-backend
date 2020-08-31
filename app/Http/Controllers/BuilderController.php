<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class BuilderController extends Controller
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

    public function builderSearch(Request $request){

        $builder = User::query();


            if (!empty($request->location)) {
                $builder = $builder->where('user_role', 4);
            }

            if (!empty($request->location)) {
                $builder = $builder->where('address', 'like', '%'.$request->location.'%');
            }

            if (!empty($request->location)) {
                $builder = $builder->where('city', 'like', '%'.$request->location.'%');
            }
            if (!empty($request->location)) {
                $builder = $builder->where('state', 'like', '%'.$request->location.'%');
            }
            if (!empty($request->location)) {
                $builder = $builder->where('country', 'like', '%'.$request->location.'%');
            }
            if (!empty($request->location)) {
                $builder = $builder->where('company_address', 'like', '%'.$request->location.'%');
            }
            if (!empty($request->name)) {
                $builder = $builder->where('firstname', 'like', '%'.$request->name.'%');
            }
            if (!empty($request->name)) {
                $builder = $builder->where('lastname', 'like', '%'.$request->name.'%');
            }


        $builder = $builder->get();
        return response($builder);
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
