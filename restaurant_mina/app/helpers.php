<?php
/**
 * //////////////////////////////////////////////////////////////////
 * //////////////////////////////////////////////////////////////////
 * all the helper function for Mina
 *
 */
use App\Models\Setting;
use Carbon\Carbon;

/**
 * function to generate the taekout time dropdown as per the current time for weekends and weekdays
 * @param void
 * @return __mina_takeout_dropdown
 */

function generateTakeoutTime($takeout_interval=15,$branch="norimatsu-store"){
    $has_set_pickup_time = false;
	$_return_html  = '<select name="__pickup_time" class="form-control" id="__pickup_time">';
    //check the session has branch name or not
    if(session()->has('_pickup_branch_name'))
        $branch = session()->get('_pickup_branch_name');

    //check the session has the pickup time or not
    if(session()->has('pickup_time')):
        $has_set_pickup_time = true;
        $pickup_time = session()->get('pickup_time');
    else:
        $_return_html .= '<option value="" disabled selected>'.__("form.takeout.select-pickup-time").'</option>';
    endif;

    //only show the pickup time as per the selected branch only
    if(session()->has('_pickup_branch_name')):
	$current_date_time = Carbon::now();
        $weekday = Carbon::parse($current_date_time)->format('N');
        if($weekday == 6 || $weekday == 7):
            //mina weekend 
            //luch open time
            $__lunch_open_time = Setting::where('meta_key',$branch.'-weekend-lunch-open-time')->first();
            //lunch close time
            $__lunch_close_time = Setting::where('meta_key',$branch.'-weekend-lunch-close-time')->first();
            //dinner open time 
            $__dinner_open_time = Setting::where('meta_key',$branch.'-weekend-dinner-open-time')->first();
            //dinner close time
            $__dinner_close_time = Setting::where('meta_key',$branch.'-weekend-dinner-close-time')->first();
        else:
            //mina weekday
            //luch open time
            $__lunch_open_time = Setting::where('meta_key',$branch.'-weekday-lunch-open-time')->first();
            //lunch close time
            $__lunch_close_time = Setting::where('meta_key',$branch.'-weekday-lunch-close-time')->first();
            //dinner open time 
            $__dinner_open_time = Setting::where('meta_key',$branch.'-weekday-dinner-open-time')->first();
            //dinner close time
            $__dinner_close_time = Setting::where('meta_key',$branch.'-weekday-dinner-close-time')->first();
        endif;
        //loop throgh the lunc time
        $__current_time     = strtotime(Carbon::now());
        $_lunch_start_time  = strtotime($__lunch_open_time->meta_value);
        $_lunch_end_time    = strtotime($__lunch_close_time->meta_value);
        $_dinner_start_time = strtotime($__dinner_open_time->meta_value);
        $_dinner_end_time   = strtotime($__dinner_close_time->meta_value);
        //lunch takeout options
        
        if($__current_time <= $_lunch_start_time):

            //show all option for that one
            while($_lunch_start_time <= $_lunch_end_time){
                    $_return_html .= "<option value='".date("H:i",$_lunch_start_time)."'";
                    if($has_set_pickup_time && ($pickup_time == date("H:i",$_lunch_start_time))):
                        $_return_html .= "selected";
                    endif;
                    $_return_html .= '>' . date("H:i",$_lunch_start_time) .'</option>';
                    $_lunch_start_time = strtotime("+".$takeout_interval ." minutes",$_lunch_start_time);
            }
        else:
            //
            $__current_time = strtotime("+10 minutes",$__current_time);
            if($__current_time > $_lunch_start_time && $__current_time <= $_lunch_end_time):
                while($_lunch_start_time <= $_lunch_end_time){
                        if($_lunch_start_time < $__current_time):
                            $_lunch_start_time = strtotime("+".$takeout_interval ." minutes",$_lunch_start_time);
                            continue;
                        else:
                            $_return_html .= "<option value='".date("H:i",$_lunch_start_time)."'";
                            if($has_set_pickup_time && ($pickup_time == date("H:i",$_lunch_start_time))):
                                $_return_html .= "selected";
                            endif;
                            $_return_html .= '>' . date("H:i",$_lunch_start_time) .'</option>';
                            $_lunch_start_time = strtotime("+".$takeout_interval ." minutes",$_lunch_start_time);
                        endif;
                }
            endif;
        endif;


        if($__current_time <= $_dinner_start_time):
            //in the lunch time
             while($_dinner_start_time <= $_dinner_end_time){
                 $_return_html .= "<option value='".date("H:i",$_dinner_start_time)."'";
                    if($has_set_pickup_time && ($pickup_time == date("H:i",$_dinner_start_time))):
                        $_return_html .= "selected";
                    endif;
                 $_return_html .= '>' . date("H:i",$_dinner_start_time) .'</option>';
                 $_dinner_start_time = strtotime("+".$takeout_interval ." minutes",$_dinner_start_time);
            }
        else:
            //in the dinner time
            if($__current_time > $_dinner_start_time && $__current_time <= $_dinner_end_time):
                while($_dinner_start_time <= $_dinner_end_time){
                     if($_dinner_start_time < $__current_time):
                        $_dinner_start_time = strtotime("+".$takeout_interval ." minutes",$_dinner_start_time);
                        continue;
                    else:
                       $_return_html .= "<option value='".date("H:i",$_dinner_start_time)."'";
                        if($has_set_pickup_time && ($pickup_time == date("H:i",$_dinner_start_time))):
                            $_return_html .= "selected";
                        endif;
                        $_return_html .= '>' . date("H:i",$_dinner_start_time) .'</option>';
                        $_dinner_start_time = strtotime("+".$takeout_interval ." minutes",$_dinner_start_time);
                    endif;
                }
            endif;
        endif;
    endif; // session branch  if end here
        $_return_html .= "</select>";

       return $_return_html;

}

function checkTakeoutTime(){

}