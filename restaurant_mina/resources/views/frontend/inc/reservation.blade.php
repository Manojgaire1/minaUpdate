<div class="form-wrapper">
<form action="#" method="post" id="reservationForm">
	@csrf
	<div class="row">
		<div class="col-sm-6 col-md-6">
			<div class="form-group">
				<label>{{ __('form.fullname') }} <span class="__form_required">*</span></label>
				<input type="text" class="form-control" name="fullname" id="fullname" />
			</div>
		</div>
		<div class="col-sm-6 col-md-6">
			<div class="form-group">
				<label>{{ __('form.email') }} <span class="__form_required">*</span></label>
				<input type="email" class="form-control" name="email" id="email"/>
			</div>
		</div>
		<div class="col-sm-6 col-md-6">
			<div class="form-group">
				<label>{{ __('form.phone') }} <span class="__form_required">*</span></label>
				<input type="number" class="form-control"  name="phone" id="phone"/>
			</div>
		</div>
		<input type="hidden" name="reservationType" value="reservation" />
		<div class="col-sm-6 col-md-6">
			<div class="form-group">
				<label>{{ __('form.date-time') }} <span class="__form_required">*</span></label>
				<div class='input-group date' id='datetimepicker1'>
					<input type="text" class="form-control" name="reservation_date" id="reservation_date" placeholder="DD/MM/YYYY HH:MM"/>
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-md-6">
			<div class="form-group">
				<label>{{ __('form.persons') }} <span class="__form_required">*</span></label>
				<select class="form-control" name="persons">
					<option value="1">1 {{ __('form.person-dropdown') }}</option>
					<option value="2">2 {{ __('form.persons-dropdown') }}</option>
					<option value="3">3 {{ __('form.persons-dropdown') }}</option>
					<option value="4">4 {{ __('form.persons-dropdown') }}</option>
					<option value="5">5 {{ __('form.persons-dropdown') }}</option>
					<option value="6">6 {{ __('form.persons-dropdown') }}</option>
					<option value="7">7 {{ __('form.persons-dropdown') }}</option>
					<option value="8">8 {{ __('form.persons-dropdown') }}</option>
					<option value="9">9 {{ __('form.persons-dropdown') }}</option>
					<option value="10">10 {{ __('form.persons-dropdown') }}</option>
					<option value="11">11 {{ __('form.persons-dropdown') }}</option>
					<option value="12">12 {{ __('form.persons-dropdown') }}</option>
					<option value="13">13 {{ __('form.persons-dropdown') }}</option>
					<option value="14">14 {{ __('form.persons-dropdown') }}</option>
					<option value="15">15 {{ __('form.persons-dropdown') }}</option>
					<option value="16">16 {{ __('form.persons-dropdown') }}</option>
					<option value="17">17 {{ __('form.persons-dropdown') }}</option>
					<option value="18">18 {{ __('form.persons-dropdown') }}</option>
					<option value="19">19 {{ __('form.persons-dropdown') }}</option>
					<option value="20">20 {{ __('form.persons-dropdown') }}</option>
					<option value="21">21 {{ __('form.persons-dropdown') }}</option>
					<option value="22">22 {{ __('form.persons-dropdown') }}</option>
					<option value="23">23 {{ __('form.persons-dropdown') }}</option>
					<option value="24">24 {{ __('form.persons-dropdown') }}</option>
					<option value="25">25 {{ __('form.persons-dropdown') }}</option>
					<option value="26">26 {{ __('form.persons-dropdown') }}</option>
					<option value="27">27 {{ __('form.persons-dropdown') }}</option>
					<option value="28">28 {{ __('form.persons-dropdown') }}</option>
					<option value="29">29 {{ __('form.persons-dropdown') }}</option>
					<option value="30">30 {{ __('form.persons-dropdown') }}</option>
				</select>
			</div>
		</div>
		<div class="col-sm-6 col-md-6">
			<div class="form-group">
				<label>{{ __('form.branch') }} <span class="__form_required">*</span></label>
				<select class="form-control" name="branch">
					@foreach($branches as $branch)
					<option value="{{$branch->slug}}">{{$branch->name}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<!-- <div class="col-md-8">
		</div> -->
		<div class="col-sm-12 col-md-12">
			<div class="form-group">
				<label>{{ __('form.message') }}</label>
				<textarea class="form-control" name="message" rows="5"></textarea>
			</div>
		</div>
	</div>
	<div class="reservation_submit_btn">
		<button type="submit" class="btn btn-large btn-reservation-submit-btn submit-reservation-btn">{{ __('lang.reservation-btn') }}</button>
		<p>{{ __('lang.reservation-note') }}</p>
	</div>
</form></div>