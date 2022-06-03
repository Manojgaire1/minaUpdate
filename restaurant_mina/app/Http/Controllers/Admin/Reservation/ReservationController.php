<?php

namespace App\Http\Controllers\Admin\Reservation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->ajax()):
            $reservations = Reservation::select('*')->orderBy('id','desc');
            return Datatables($reservations)
            ->addColumn('status', function($reservation){
                if($reservation->status == 0):
                    return 'Pending';
                elseif($reservation->status == 1):
                    return 'Confirmed';
                else:
                    return 'Cancelled';
                endif;
            })
            ->addColumn('action', function ($reservation) {
                $return_html = '<div class="dropdown">' .
                    '<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ti-more-alt"></i></button>' .
                    '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" >' .
                    '<ul>' .
                    '<li><button class="dropdown-item edit-btn" data-reservation-id = "'.$reservation->id.'" href = "#" data-reservation-status="'.$reservation->status.'"> Edit</button ></li >'.
                    '<li ><a class="dropdown-item delete-btn" href = "#" data-reservation-id = '.$reservation->id.'> Delete</a ></li >'.
                    '</ul >'.
                    '</div ></div >';

                return $return_html;

            })
            ->make();
        else:
            return view('admin.reservation.index');
        endif;
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
        $data = [
            'status'  => $request->input('status'),
            'cancelled_message' => $request->input('cancelled_message') ?? null
        ];
        $change_status = Reservation::changeStatus($data,$id);
        if($change_status):
            return response()->json(array('status' => 'success' ,'message' => 'Reservation has been updated successfully','title' => 'Reservation Updated!'),200);
        else:
            return response()->json(array('status' => 'failed' ,'message' => 'Reservation cannot be updated','title' => 'Update failed!'),200);
        endif;
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
        Reservation::destroy($id);
        return response()->json(array('status' => 'success' ,'message' => 'Reservation has been deleted successfully','title' => 'Reservation Deleted!'),200);
    }
}
