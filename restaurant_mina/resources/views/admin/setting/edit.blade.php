@extends('admin.layouts.master')
@section('page_title','Mina Settings')
@section('page_specific_css')
<link href="{{asset('/admin-assets/pages/advance-elements/css/bootstrap-datetimepicker.css')}}" type="text/css" rel="stylesheet" />
<style>
	.opening_hours{
		margin-top:10px;
	}

	.hide{
		display: none;
	}
	.success_message_div{
		margin-top: 20px;
    	margin-right: 5px;
    	margin-left: 5px;
    	margin-bottom: -20px;
	}
</style>
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="pcoded-content vehicle">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">

                    <!-- end card for Breadcrumb -->
                	<div class="card card-white">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-7">
                                <h2>Settings</h2>
                            </div>
                        </div>
                    </div>
                    @if(request()->session()->has('mina_opening_hours'))
                	<div class="row success_message_div">
                		<div class="col-md-12">
                			<div class="alert alert-success" role="alert">
                				{{request()->session()->get('mina_opening_hours')}}
                				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								    <span aria-hidden="true">&times;</span>
								  </button>
                			</div>
                		</div>
                	</div>
                	@endif
                    <form action="{{route('admin.settings.update')}}" method="POST" id="__mina_settings_form" name="__mina_settings_form">
                    <div class="card-block">
                    	<h6 class="sub-title">Discount Settings</h6>
                    	<div class="row">
                    		<div class="col-md-6">
                    			<div class="form-group">
                    				<label for="enabled_discount">Enable discount</label>
                    				<select name="enable_discount" class="form-control enable_discount">
                    					<option value="enable" @if($enable_discount == "enable"){{'selected'}}@endif>Enabled</option>
                    					<option value="disable"@if($enable_discount == "disable"){{'selected'}}@endif>Disabled</option>
                    				</select>
                    			</div>
                    		</div>
                    	</div>
                    	<div class="row">
                    		<div class="col-md-12">
                    			<div class="discount_section_container @if($enable_discount == "disable"){{'hide'}}@endif">
                    				<div class="row">
                    					<div class="col-md-6">
                    						<div class="form-group">
                    							<label for="discount_name">Discount title</label>
                    							<input type="text" name="discount_name" id="discount_name" class="form-control" placeholder="20% offer"  value="{{$discount_name}}"/>
                    						</div>
                    					</div>
                    				</div>
                    				<div class="row">
                    					<div class="col-md-6">
                    						<div class="form-group">
                    							<label for="discount_start_date">Valid from</label>
	                    							<div class="input-group date" id="datetimepicker1">
	                    							<input type="text" name="discount_start_date" id="discount_start_date" class="form-control" placeholder="19/07/2020"  value="{{$discount_start_date}}"/>
	                    							<span class="input-group-addon ">
														<span class="icofont icofont-ui-calendar">
														</span>
													</span>
	                    						</div>
                    						</div>
                    					</div>
                    					<div class="col-md-6">
                    						<div class="form-group">
                    							<label for="discount_end_date">Valid till</label>
                    							<div class="input-group date" id="datetimepicker2">
                    								<input type="text" name="discount_end_date" id="discount_end_date" class="form-control" placeholder="19/09/2020" value="{{$discount_end_date}}">
                    								<span class="input-group-addon ">
														<span class="icofont icofont-ui-calendar">
														</span>
													</span>
                    							</div>
                    						</div>
                    					</div>
                    				</div>
                    				<div class="row">
                    					<div class="col-md-12">
                    						<div class="form-group">
                    							<label for="discount_weekly_frequency">Discount weekly frequency</label>
                    							<div class="border-checkbox-section">
													<div class="border-checkbox-group border-checkbox-group-danger">
														<input class="border-checkbox" type="checkbox" id="sunday" name="discount_weekly_frequency[]" value="sunday" @foreach($discount_weekly_frequency as $week)@if($week == "sunday"){{'checked'}} @endif @endforeach>
														<label class="border-checkbox-label" for="sunday">Sunday</label>
													</div>
													<div class="border-checkbox-group border-checkbox-group-danger">
														<input class="border-checkbox" type="checkbox" id="monday" name="discount_weekly_frequency[]" value="monday" @foreach($discount_weekly_frequency as $week)@if($week == "monday"){{'checked'}} @endif @endforeach>
														<label class="border-checkbox-label" for="monday">Monday</label>
													</div>
													<div class="border-checkbox-group border-checkbox-group-danger">
														<input class="border-checkbox" type="checkbox" id="tuesday" name="discount_weekly_frequency[]" value="tuesday" @foreach($discount_weekly_frequency as $week)@if($week == "tuesday"){{'checked'}} @endif @endforeach>
														<label class="border-checkbox-label" for="tuesday">Tuesday</label>
													</div>
													<div class="border-checkbox-group border-checkbox-group-danger">
														<input class="border-checkbox" type="checkbox" id="Wednesday" name="discount_weekly_frequency[]" value="wednesday" @foreach($discount_weekly_frequency as $week)@if($week == "wednesday"){{'checked'}} @endif @endforeach>
														<label class="border-checkbox-label" for="Wednesday">Wednesday</label>
													</div>
													<div class="border-checkbox-group border-checkbox-group-danger">
														<input class="border-checkbox" type="checkbox" id="thursday" name="discount_weekly_frequency[]" value="thursday" @foreach($discount_weekly_frequency as $week)@if($week == "thursday"){{'checked'}} @endif @endforeach>
														<label class="border-checkbox-label" for="thursday">Thursday</label>
													</div>
													<div class="border-checkbox-group border-checkbox-group-danger">
														<input class="border-checkbox" type="checkbox" id="friday" name="discount_weekly_frequency[]" value="friday" @foreach($discount_weekly_frequency as $week)@if($week == "friday"){{'checked'}} @endif @endforeach>
														<label class="border-checkbox-label" for="friday">Friday</label>
													</div>
													<div class="border-checkbox-group border-checkbox-group-danger">
														<input class="border-checkbox" type="checkbox" id="Saturday" name="discount_weekly_frequency[]" value="saturday" @foreach($discount_weekly_frequency as $week)@if($week == "saturday"){{'checked'}} @endif @endforeach>
														<label class="border-checkbox-label" for="Saturday">Saturday</label>
													</div>
												</div>
											</div>
                    					</div>
                    				</div>
                    				<div class="row">
                    					<div class="col-md-6">
                    						<div class="form-group">
                    							<label for="discount_type">Discount type</label>
                    							<select name="discount_type" class="form-control discount_type">
                    								<option value="all"  @if($discount_type == "all"){{'selected'}}@endif>All Day</option>
                    								<option value="lunch_only" @if($discount_type == "lunch_only"){{'selected'}}@endif>Lunch only</option>
                    								<option value="dinner_only" @if($discount_type == "dinner_only"){{'selected'}}@endif>Dinner only</option>
                    								<option value="lunch_and_dinner" @if($discount_type == "lunch_and_dinner"){{'selected'}}@endif>Lunch and dinner</option>
                    							</select>
                    						</div>
                    					</div>
                    				</div>
                    				<div class="row lunch_and_dinner_container @if($discount_type != "lunch_and_dinner"){{'hide'}}@endif">
                    					<div class="col-md-6">
                    						<!-- lunch amount-->
                    						<h6 class="sub-title">Lunch offer</h6>
                    						<div class="row">
                    							<div class="col-md-12">
                    								<div class="form-group">
		                    							<label for="discount_lunch_amount_type">Discount amount type</label>
		                    							<select name="discount_lunch_amount_type" class="form-control">
		                    								<option value="percent" @if($discount_lunch_amount_type == "percent"){{'selected'}}@endif>Percentage(%)</option>
		                    								<option value="amount" @if($discount_lunch_amount_type == "amount"){{'selected'}}@endif>Amount(¥)</option>
		                    							</select>
		                    						</div>
                    							</div>
                    							<div class="col-md-12">
                    								<div class="form-group">
		                    							<label for="discount_lunch_amount">Value</label>
		                    							<input type="number" name="discount_lunch_amount" id="discount_lunch_amount" placeholder="¥200 / 20%" class="form-control" step="0.01" value="{{$discount_lunch_amount}}">
		                    						</div>
                    							</div>
                    						</div>
                    					</div>
                    					<div class="col-md-6">
                    						<h6 class="sub-title">Dinner offer</h6>
                    						<div class="row">
                    							<div class="col-md-12">
                    								<div class="form-group">
		                    							<label for="discount_dinner_amount_type">Discount amount type</label>
		                    							<select name="discount_dinner_amount_type" class="form-control">
		                    								<option value="percent" @if($discount_dinner_amount_type == "percent"){{'selected'}}@endif >Percentage(%)</option>
		                    								<option value="amount" @if($discount_dinner_amount_type == "amount"){{'selected'}}@endif>Amount(¥)</option>
		                    							</select>
		                    						</div>
                    							</div>
                    							<div class="col-md-12">
                    								<div class="form-group">
		                    							<label for="discount_dinner_amount">Value</label>
		                    							<input type="number" name="discount_dinner_amount" id="discount_dinner_amount" placeholder="¥200 / 20%" class="form-control" step="0.01" value="{{$discount_dinner_amount}}">
		                    						</div>
                    							</div>
                    						</div>
                    					</div>
                    				</div>
                    				<div class="row lunch_or_dinner_container @if($discount_type == 'lunch_and_dinner'){{'hide'}}@endif">
                    					<div class="col-md-6">
                    						<div class="form-group">
                    							<label for="discount_amount_type">Discount amount type</label>
                    							<select name="discount_amount_type" class="form-control">
                    								<option value="percent" @if($discount_amount_type == "percent"){{'selected'}}@endif >Percentage(%)</option>
                    								<option value="amount" @if($discount_amount_type == "amount"){{'selected'}}@endif>Amount(¥)</option>
                    							</select>
                    						</div>
                    					</div>
                    					<div class="col-md-6">
                    						<div class="form-group">
                    							<label for="discount_amount">Value</label>
                    							<input type="number" name="discount_amount" id="discount_amount" placeholder="¥200 / 20%" class="form-control" step="0.01" value="{{$discount_amount}}">
                    						</div>
                    					</div>
                    				</div>
                    			</div>
                    		</div>
                    	</div>
                    	<h6 class="sub-title opening_hours">Mina opening / closing hours settings</h6>
                    	<div class="row">
                    		<div class="col-md-12">
                    			<div class="__mina_settings">
                    					@csrf
                    					@foreach($branches as $branch)
                    					<h6 class="sub-title opening_hours">{{$branch->en_name}}</h6>
                	                    <div class="row">
	            							<div class="col-md-6">
	                							<div class="form-group">
	                								<label for="{{$branch->slug}}-weekday-lunch-open-time">{{$branch->en_name }} Weekday lunch open time (MON-FRI)</label>
													<div class="input-group date" id="{{$branch->slug}}-weekday-lunch-open-time-picker">
														<input type="text" class="form-control {{$branch->slug}}-weekday-lunch-open-time" name="{{$branch->slug}}-weekday-lunch-open-time" id="{{$branch->slug}}-weekday-lunch-open-time" value="
														@foreach($settings as $index=>$setting)
															@if(array_key_exists('meta_key',$setting) && $setting['meta_key'] == $branch->slug.'-weekday-lunch-open-time')
															 {{$setting['meta_value']}}
															@endif
														@endforeach
														">
														<span class="input-group-addon ">
															<span class="icofont icofont-ui-calendar">
															</span>
														</span>
													</div>
	                							</div>
		                					</div>
                							<div class="col-md-6">
	                							<div class="form-group">
	                								<label for="{{$branch->slug}}-weekday-lunch-close-time">{{$branch->en_name }} Weekday lunch close time (MON-FRI)</label>
													<div class="input-group date" id="{{$branch->slug}}-weekday-lunch-close-time-picker">
														<input type="text" class="form-control {{$branch->slug}}-weekday-lunch-close-time" name="{{$branch->slug}}-weekday-lunch-close-time" id="{{$branch->slug}}-weekday-lunch-close-time" value="
														@foreach($settings as $index=>$setting)
															@if(array_key_exists('meta_key',$setting) && $setting['meta_key'] == $branch->slug.'-weekday-lunch-close-time')
															 {{$setting['meta_value']}}
															@endif
														@endforeach
														">
														<span class="input-group-addon ">
															<span class="icofont icofont-ui-calendar">
															</span>
														</span>
													</div>
	                							</div>
	                						</div>
                    						<div class="col-md-6">
	                							<div class="form-group">
	                								<label for="{{$branch->slug}}-weekend_lunch_open_time">{{$branch->en_name }} Weekend lunch open time (SAT-SUN)</label>
													<div class="input-group date" id="{{$branch->slug}}-weekend-lunch-open-time-picker">
														<input type="text" class="form-control {{$branch->slug}}-weekend-lunch-open-time" name="{{$branch->slug}}-weekend-lunch-open-time" id="{{$branch->slug}}-weekend-lunch-open-time" value="
														@foreach($settings as $index=>$setting)
															@if(array_key_exists('meta_key',$setting) && $setting['meta_key'] == $branch->slug.'-weekend-lunch-open-time')
															 {{$setting['meta_value']}}
															@endif
														@endforeach
														">
														<span class="input-group-addon ">
															<span class="icofont icofont-ui-calendar">
															</span>
														</span>
													</div>
	                							</div>
	                						</div>
                    						<div class="col-md-6">
	                							<div class="form-group">
	                								<label for="{{$branch->slug}}-weekend-lunch-close-time">{{$branch->en_name }} Weekend lunch close time (SAT-SUN)</label>
													<div class="input-group date" id="_{{$branch->slug}}-weekend-lunch-close-time-picker">
														<input type="text" class="form-control {{$branch->slug}}-weekend-lunch-close-time" name="{{$branch->slug}}-weekend-lunch-close-time" id="{{$branch->slug}}-weekend-lunch-close-time" value="
														@foreach($settings as $index=>$setting)
															@if(array_key_exists('meta_key',$setting) && $setting['meta_key'] == $branch->slug.'-weekend-lunch-close-time')
															 {{$setting['meta_value']}}
															@endif
														@endforeach
														">
														<span class="input-group-addon ">
															<span class="icofont icofont-ui-calendar">
															</span>
														</span>
													</div>
	                							</div>
	                						</div>
                    						<div class="col-md-6">
	                							<div class="form-group">
	                								<label for="{{$branch->slug}}-weekday-dinner-open-time">{{$branch->en_name }} Weekday dinner open time (MON-FRI)</label>
													<div class="input-group date" id="{{$branch->slug}}-weekday-dinner-open-time-picker">
														<input type="text" class="form-control {{$branch->slug}}-weekday-dinner-open-time" name="{{$branch->slug}}-weekday-dinner-open-time" id="{{$branch->slug}}-weekday-dinner-open-time" value="
														@foreach($settings as $index=>$setting)
															@if(array_key_exists('meta_key',$setting) && $setting['meta_key'] == $branch->slug.'-weekday-dinner-open-time')
															 {{$setting['meta_value']}}
															@endif
														@endforeach
														">
														<span class="input-group-addon ">
															<span class="icofont icofont-ui-calendar">
															</span>
														</span>
													</div>
	                							</div>
	                						</div>
                    						<div class="col-md-6">
	                							<div class="form-group">
	                								<label for="{{$branch->slug}}-weekday-dinner-close-time">{{$branch->en_name }} Weekday dinner close time (MON-FRI)</label>
													<div class="input-group date" id="{{$branch->slug}}-weekday-dinner-close-time-picker">
														<input type="text" class="form-control {{$branch->slug}}-weekday-dinner-close-time" name="{{$branch->slug}}-weekday-dinner-close-time" id="{{$branch->slug}}-weekday-dinner-close-time" value="
														@foreach($settings as $index=>$setting)
															@if(array_key_exists('meta_key',$setting) && $setting['meta_key'] == $branch->slug.'-weekday-dinner-close-time')
															 {{$setting['meta_value']}}
															@endif
														@endforeach
														">
														<span class="input-group-addon ">
															<span class="icofont icofont-ui-calendar">
															</span>
														</span>
													</div>
	                							</div>
	                						</div>
                    						<div class="col-md-6">
	                							<div class="form-group">
	                								<label for="{{$branch->slug}}-weekend-dinner-open-timee">{{$branch->en_name }} Weekend dinner open time (SAT-SUN)</label>
													<div class="input-group date" id="{{$branch->slug}}-weekend-dinner-open-time-picker">
														<input type="text" class="form-control {{$branch->slug}}-weekend-dinner-open-time" name="{{$branch->slug}}-weekend-dinner-open-time" id="{{$branch->slug}}-weekend-dinner-open-time" value="
														@foreach($settings as $index=>$setting)
															@if(array_key_exists('meta_key',$setting) && $setting['meta_key'] == $branch->slug.'-weekend-dinner-open-time')
															 {{$setting['meta_value']}}
															@endif
														@endforeach
														">
														<span class="input-group-addon ">
															<span class="icofont icofont-ui-calendar">
															</span>
														</span>
													</div>
	                							</div>
	                						</div>
                    						<div class="col-md-6">
	                							<div class="form-group">
	                								<label for="{{$branch->slug}}-weekend-dinner-close-time">{{$branch->en_name }} Weekend dinner close time (SAT-SUN)</label>
													<div class="input-group date" id="{{$branch->slug}}-weekend-dinner-close-time-picker">
														<input type="text" class="form-control {{$branch->slug}}-weekend-dinner-close-time" name="{{$branch->slug}}-weekend-dinner-close-time" id="{{$branch->slug}}-weekend-dinner-close-time" value="
														@foreach($settings as $index=>$setting)
															@if(array_key_exists('meta_key',$setting) && $setting['meta_key'] == $branch->slug.'-weekend-dinner-close-time')
															 {{$setting['meta_value']}}
															@endif
														@endforeach
														">
														<span class="input-group-addon ">
															<span class="icofont icofont-ui-calendar">
															</span>
														</span>
													</div>
	                							</div>
	                						</div>
                    					</div>
                    					@endforeach
                    					<div class="row">
                    						<div class="col-sm-4">
	                    						<div class="form-group">
	                    							<input type="submit" class="btn btn-md __btn_global" value="update">
	                    						</div>
	                    					</div>
                    					</div>
                    				</form>
                    			</div>
                    		</div>
                    	</div>
                    </div>
					</div>


                </div>
                <!-- end page -->
            </div>

        </div>
    </div>
</div>
@endsection
@section('page_specific_js')
<script src="{{asset('/admin-assets/pages/advance-elements/moment-with-locales.min.js')}}"/></script>
<script src="{{asset('/admin-assets/pages/advance-elements/bootstrap-datetimepicker.min.js')}}"/></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
	$(document).ready(function(){
		var branch_slug = {!!json_encode($branches_slug)!!}
		var date_index = "";
		var i=0;
		$.each(branch_slug,function(index,jsonObject){
			$.each(jsonObject, function(key,value){
				if(i > 0){
					date_index += ","
				}
				date_index +="#" + value +"-weekday-lunch-open-time,#" + value + "-weekday-lunch-close-time,#"+value+"-weekend-lunch-open-time,#"+value+"-weekend-lunch-close-time,#"+ value + "-weekday-dinner-open-time,#"+value+"-weekday-dinner-close-time,#" + value + "-weekend-dinner-open-time,#"+ value + "-weekend-dinner-close-time"
				i++;
			})
		})
		$(date_index).datetimepicker({
			format:'HH:mm',
			//showMeridian: false,
			icons:{
				time:"icofont icofont-clock-time",
				date:"icofont icofont-ui-calendar",
				up:"icofont icofont-rounded-up",
				down:"icofont icofont-rounded-down",
				next:"icofont icofont-rounded-right",
				previous:"icofont icofont-rounded-left"
			}
		});
		 $('#discount_start_date,#discount_end_date').flatpickr({
            'enableTime': false,
            'format': 'D/M/Y',
            "minDate": "today",
        });

		 //show the discount container if it enabled
		 $('.enable_discount').on('change',function(e){
		 	//prevent the default action
		 	e.preventDefault()
		 	if($(this).val() == "enable"){
		 		$('.discount_section_container').removeClass('hide')
		 	}else{
		 		$('.discount_section_container').addClass('hide')
		 	}
		 	
		 })

		 //show the lunch / dinner container as per the discount type
		 $('.discount_type').on('change',function(e){
		 	//prevent the default action
		 	e.preventDefault()
		 	if($(this).val() == "lunch_and_dinner"){
		 		$('.lunch_and_dinner_container').removeClass('hide')
		 		$('.lunch_or_dinner_container').addClass('hide')
		 	}else{
		 		$('.lunch_and_dinner_container').addClass('hide')
		 		$('.lunch_or_dinner_container').removeClass('hide')
		 	}
		 })

	})
</script>
@endsection