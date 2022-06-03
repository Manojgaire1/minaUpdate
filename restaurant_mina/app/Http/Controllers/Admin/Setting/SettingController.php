<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Branch;
class SettingController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $branches                    = Branch::all();
        $branches_slug               = Branch::select('slug')->get();
        $setting_details             = Setting::select('meta_key','meta_value','id')->get();
        $enable_discount             = "enable";
        $discount_name               = "";
        $discount_start_date         ="";
        $discount_end_date           = "";
        $discount_weekly_frequency   = array();
        $discount_type               = "all";
        $discount_amount_type        = "percent";
        $discount_amount             = 0.00;
        $discount_lunch_amount_type = "percent";
        $discount_lunch_amount       = 0.00;
        $discount_dinner_amount_type = "percent";
        $discount_dinner_amount      = 0.00;

        foreach($setting_details as $setting_detail){
            if($setting_detail->meta_key == "enable_discount"){
                $enable_discount = $setting_detail->meta_value;
            }

            if($setting_detail->meta_key == "discount_name"){
                $discount_name = $setting_detail->meta_value;
            }

            if($setting_detail->meta_key == "discount_start_date"){
                $discount_start_date = $setting_detail->meta_value;
            }

            if($setting_detail->meta_key == "discount_end_date"){
                $discount_end_date = $setting_detail->meta_value;
            }

            if($setting_detail->meta_key == "discount_type"){
                $discount_type = $setting_detail->meta_value;
            }

            if($setting_detail->meta_key == "discount_amount_type"){
                $discount_amount_type = $setting_detail->meta_value;
            }

            if($setting_detail->meta_key == "discount_amount"){
                $discount_amount = $setting_detail->meta_value;
            }

            if($setting_detail->meta_key == "discount_lunch_amount_type"){
                $discount_lunch_amount_type = $setting_detail->meta_value;
            }

            if($setting_detail->meta_key == "discount_lunch_amount"){
                $discount_lunch_amount = $setting_detail->meta_value;
            }

            if($setting_detail->meta_key == "discount_dinner_amount_type"){
                $discount_dinner_amount_type = $setting_detail->meta_value;
            }

            if($setting_detail->meta_key == "discount_dinner_amount"){
                $discount_dinner_amount = $setting_detail->meta_value;
            }

            if($setting_detail->meta_key == "discount_weekly_frequency"){
                $discount_weekly_frequency = unserialize($setting_detail->meta_value);
            }



        }
        $settings = Setting::select('meta_key','meta_value','id')->get()->toArray();
        return view('admin.setting.edit')->with([
            'settings'                      => $settings,
            'branches'                      => $branches,
            'branch_lists'                  => $branches,
            'branches_slug'                 => $branches_slug,
            'enable_discount'               => $enable_discount,
            'discount_name'                 => $discount_name,
            'discount_start_date'           => $discount_start_date,
            'discount_end_date'             => $discount_end_date,
            'discount_type'                 => $discount_type,
            'discount_amount_type'          => $discount_amount_type,
            'discount_amount'               => $discount_amount,
            'discount_lunch_amount_type'    => $discount_lunch_amount_type,
            'discount_lunch_amount'         => $discount_lunch_amount,
            'discount_dinner_amount_type'   => $discount_lunch_amount_type,
            'discount_dinner_amount'        => $discount_dinner_amount,
            'discount_weekly_frequency'     => $discount_weekly_frequency
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $data = $request->except("_token");
        foreach($data as $key=>$value):
            $this->updateSetting($request,$key,$value);
        endforeach;
        //
        $request->session()->flash('mina_opening_hours','Mina settings has been updated successfully!');
        return redirect()->route('admin.settings.create');
    

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


    protected function updateSetting($request,$key,$value){
        if($request->has($key) && $request->get($key) != null):
            //upate setting
            //check the setting or not if not insert it
            $open_time_exists = Setting::where('meta_key',$key)->first();
            //check for the weekly frequencye
            if($key != "discount_weekly_frequency"):
                if($open_time_exists):
                     $update_data  = [
                        'meta_value'  => $request->input($key),
                        'updated_at'  => now()
                    ];  
                    Setting::where('meta_key',$key)->update($update_data);
                else:
                    //if not exist then insert new one
                    $setting              = new Setting();
                    $setting->meta_key    = $key;
                    $setting->meta_value  = $request->input($key);
                    $setting->updated_at  = now();
                    $setting->created_at  = now();
                    $setting->save();
                endif;
            else:
                //delete the serialize array and insert the new one
                Setting::where('meta_key',$key)->delete();
                $updated_weekly_frequency = serialize($request->get($key));
                $setting              = new Setting();
                $setting->meta_key    = $key;
                $setting->meta_value  = $updated_weekly_frequency;
                $setting->updated_at  = now();
                $setting->created_at  = now();
                $setting->save();
            endif;
        endif;

    }
}
