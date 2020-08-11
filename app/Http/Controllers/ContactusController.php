<?php

namespace App\Http\Controllers;

use App\Contactus;
use Illuminate\Http\Request;

class ContactusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact = Contactus::all();
        return response([

            'Contactus' => $contact,
            'message' => 'All Request Loaded Successfully'

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
        $request->validate([
            'email' => 'required|string|email|max:255',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'phoneNumber' => 'string',
            'subject' => 'string',
            'message' => 'required|string',
        ]);

        $contact = new Contactus([

            'email' =>  $request->get('email'),
            'firstname' =>  $request->get('firstName'),
            'lastname' => $request->get('lastName'),
            'phone_number' => $request->get('phoneNumber'),
            'subject' => $request->get('subject'),
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
     * @param  \App\Contactus  $contactus
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contactus::where('id', $id)->get();
        return response([ 'property' => $contact, 'message' => 'Request Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contactus  $contactus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contactus $contactus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contactus  $contactus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contactus $contactus)
    {
        //
    }
}
