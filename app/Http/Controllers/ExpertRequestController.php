<?php

namespace App\Http\Controllers;

use App\Qustionaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpertRequestController extends Controller
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

    public function expertRequest(Request $request)
    {

        $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|string|email',
            'phone' => 'required|string',
            'requestType' => 'required|string',
            'location' => 'required|string',
        ]);

        $user = new Qustionaire([

            'first_name' =>  $request->get('firstName'),
            'last_name' => $request->get('lastName'),
            'email' =>  $request->get('email'),
            'location' =>  $request->get('location'),
            'phone' => $request->get('phone'),
            'requestType' => $request->get('requestType'),
            'question' => $request->get('questionsAndAnswer'),

                ]);

            $user->save();

            return response([

               'user' => $user,
               'message' => 'User Created Successfully'

                ]);

        // try {

        //     $expertUser = ExpertRequestUser::create([
        //         'first_name' => $request->get('firstName'),
        //         'last_name' => $request->get('lastName'),
        //         'email' => $request->get('email'),
        //         'phone' => $request->get('phone')
        //     ]);

        //     // $expertUser->expertRequestQuestions()->create([
        //     //     'expert_request_type' => $request->get('expertRequestType'),
        //     //     'question' => $request->get('question'),
        //     //     'answer' => $request->get('answer')
        //     // ]);

        //     DB::begintransaction();
        //     // $order = Order::create($orderData); // change the model here
        //     // foreach($request->getquestion as $r){
        //     //     dd($r->get('question'));
        //     // }

        //     // dd($request);
        //     // dd($request->get('question'));
        // $expertRequest = [];
        // foreach($request as $request) {
        //     //  $product = Product::find($product_id); // validations the product id
        //      $expertRequest[] = $expertUser->expertRequestQuestions()->create([
        //         'expert_request_type' => $request->get('expertRequestType'),
        //         'question' => $request->get('question'),
        //         'answer' => $request->get('answer')
        //     ]);

        //      // must be create new table

        //      // You can also store this way, but its still in loop so putting under comment.
        //      // $orderProducts = orderProducts::create($tmpData);

        //  }

        // //  $orderProducts::insert($expertRequest);

        // DB::commit();
        // } catch (Exception $e) {
        //     DB::rollback();

        //     throw $e; // modify with, How you handle your error response.
        // }


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
     * @param  \App\ExpertRequestUser  $expertRequestUser
     * @return \Illuminate\Http\Response
     */
    public function show(ExpertRequestUser $expertRequestUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExpertRequestUser  $expertRequestUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpertRequestUser $expertRequestUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExpertRequestUser  $expertRequestUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpertRequestUser $expertRequestUser)
    {
        //
    }
}
