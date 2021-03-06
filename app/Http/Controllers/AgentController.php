<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents = User::where('user_role', '3')->get();
        return response($agents);
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

    public function agentSearch(Request $request){

        $agent = User::query();


            if (!empty($request->location)) {
                $agent = $agent->where('user_role', 3);
            }

            if (!empty($request->location)) {
                $agent = $agent->where('address', 'like', '%'.$request->location.'%');
            }

            if (!empty($request->location)) {
                $agent = $agent->where('city', 'like', '%'.$request->location.'%');
            }
            if (!empty($request->location)) {
                $agent = $agent->where('state', 'like', '%'.$request->location.'%');
            }
            if (!empty($request->location)) {
                $agent = $agent->where('country', 'like', '%'.$request->location.'%');
            }
            if (!empty($request->location)) {
                $agent = $agent->where('company_address', 'like', '%'.$request->location.'%');
            }
            if (!empty($request->name)) {
                $agent = $agent->where('firstname', 'like', '%'.$request->name.'%');
            }
            if (!empty($request->name)) {
                $agent = $agent->where('lastname', 'like', '%'.$request->name.'%');
            }


        $agent = $agent->get();
        return response($agent);
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
