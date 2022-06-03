<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use App\Mail\ContactEmail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('frontend.contact')->with([
            'page_name'  => 'Contact'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //check for the validation
        $validatedData = $request->validate([
            'fullname'         => 'required|min:4',
            'email'            => 'required|email',
            'phone'            => 'required|min:8|max:14',
            'subject'          => 'required'
        ]);

        //validated
        $data                  = [
            'customer_name'    => $request->input('fullname'),
            'customer_email'   => $request->input('email'),
            'customer_phone'   => $request->input('phone'),
            'subject'          => $request->input('subject'),
            'message'          => $request->input('message')
        ];
        //send the email to the 
        Mail::to('support@indianrestaurantmina.com')->send(new ContactEmail($data));
        return response()->json(array('status' => 'success', 'message' => __('form.contact-success-message'),'title' =>  __('form.contact-success-title')),200);
       
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
