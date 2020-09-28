<?php

namespace App\Http\Controllers;

use App\ContactAgent;
use Illuminate\Http\Request;

class ContactAgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $contact = ContactAgent::all();
        $contact = ContactAgent::where('agent_id', auth()->user()->id)->get();
        return response([

            'Contactus' => $contact,
            'message' => 'All Request Loaded Successfully'

             ]);
    }

    // public function getAgentMessage()
    // {
    //     // $contact = ContactAgent::all();
    //     $contact = ContactAgent::where('agent_id', auth()->user()->id)->get();
    //     return response([

    //         'Contactus' => $contact,
    //         'message' => 'All Request Loaded Successfully'

    //          ]);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'agentId' => 'required',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'phoneNumber' => 'string',
            'message' => 'required|string',
        ]);
// Add ownerId if the user is logged in
        $contact = new ContactAgent([

            'email' =>  $request->get('email'),
            'agent_id' =>  $request->get('agentId'),
            'owner_id' => $request->get('ownerId'),
            'firstname' =>  $request->get('firstName'),
            'lastname' => $request->get('lastName'),
            'phone_number' => $request->get('phoneNumber'),
            'message' => $request->get('message')

                ]);

            $contact->save();

            return response([

               'message' => 'Message Submitted Successfully'

                ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContactAgent  $contactAgent
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = ContactAgent::where('id', $id)->get();


        $contact->isRead = 1;
        $contact->save();

        return response([ 'property' => $contact, 'message' => 'Request Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContactAgent  $contactAgent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactAgent $contactAgent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContactAgent  $contactAgent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contactAgent = ContactAgent::findOrFail($id);

        $contactAgent->delete();
        return response([
            'message' => 'Request Deleted Successfully'
        ]);
    }
}
