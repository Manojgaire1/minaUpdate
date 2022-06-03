<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\SendReservationEmail;
use App\Mail\ReservationEmail;
use App\Models\Reservation;
use App\Models\Branch;
use Mail;

class ReservationController extends Controller
{

    protected $reservation;

    public function __construct(Reservation $reservation){
        $this->reservation = $reservation;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        
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
        //
        //validation
        if($request->has('reservationType') && $request->get('reservationType') == "reservation"):
            $validatedData = $request->validate([
                'fullname'         => 'required|min:4',
                //'email'            => 'required|email',
                'phone'            => 'required|min:8|max:14',
                'reservation_date' => 'required'
            ]);
        endif;

        if($request->has('reservationType') && $request->get('reservationType') == "modalReservation"):
            $validatedData = $request->validate([
                'customerFullname'        => 'required|min:4',
                'customerEmail'           => 'required|email',
                'customerPhone'           => 'required|min:8|max:14',
                'reservationDate'         => 'required'
            ]);
        endif;
        $data = $request->except("_token");
        //save the recored
        if($request->has('reservationType') && $request->get('reservationType') == "reservation"):
            $new_reservation = $this->reservation->createReservation($data);
            $branch_slug     = $request->input('branch');
            $emailData['customer_name']   = $request->input('fullname');
            $emailData['customer_email']  = $request->input('email');
            $emailData['customer_phone']  = $request->input('phone');
            $emailData['reservation_date']= $request->input('reservation_date');
            $emailData['peoples']         = $request->input('persons');
            $emailData['message']         = $request->input('message');
        elseif($request->has('reservationType') && $request->get('reservationType') == "modalReservation"):
            $new_reservation = $this->reservation->createModalReservation($data);
            $branch_slug     = $request->input('reservationBranch');
             $emailData['customer_name']   = $request->input('customerFullname');
            $emailData['customer_email']  = $request->input('customerEmail');
            $emailData['customer_phone']  = $request->input('customerPhone');
            $emailData['reservation_date']= $request->input('reservationDate');
            $emailData['peoples']         = $request->input('reservationPersons');
            $emailData['message']         = $request->input('reservationMessage');
        endif;
        if($new_reservation):
            //send the to the branch
            $selected_branch = Branch::where('slug',$branch_slug)->first();
            $emailData['branch_name'] = $selected_branch->en_name;
            if($selected_branch):
                Mail::to($selected_branch->email)->send(new ReservationEmail($emailData));
                return response()->json(array('status' => 'success', 'message' => __('form.reservation-success-message'),'title' =>  __('form.reservation-success-title')),200);
            else:
                return response()->json(array('status' => 'failed', 'message' => __('form.reservation-failed-message'),'title' => __('form.reservation-failed.title')),200);
            endif;
        else:
             return response()->json(array('status' => 'failed', 'message' =>__('form.reservation-failed-message'),'title' =>__('form.reservation-failed.title')),200);
        endif;
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
