$(document).ready(function(){

      // Phone masking
      $('#phone').mask('(999) 999-9999', {placeholder:'x'});

      /***************************************/
      /* Datepicker */
      /***************************************/
      // Start date
      function dateFrom(date_from, date_to) {
        $( date_from ).datepicker({
          dateFormat: 'mm/dd/yy',
          prevText: '<i class="fa fa-caret-left"></i>',
          nextText: '<i class="fa fa-caret-right"></i>',
          onClose: function( selectedDate ) {
            $( date_to ).datepicker( 'option', 'minDate', selectedDate );
          }
        });
      }

      // Finish date
      function dateTo(date_from, date_to) {
        $( date_to ).datepicker({
          dateFormat: 'mm/dd/yy',
          prevText: '<i class="fa fa-caret-left"></i>',
          nextText: '<i class="fa fa-caret-right"></i>',
          onClose: function( selectedDate ) {
            $( date_from ).datepicker( 'option', 'maxDate', selectedDate );
          }
        });
      }

      // Destroy date
      function destroyDate (date) {
        $( date ).datepicker('destroy');
      }

      // Initialize date range
      dateFrom('#date_from', '#date_to');
      dateTo('#date_from', '#date_to');
      /***************************************/
      /* end datepicker */
      /***************************************/

      // Validation
      /*$( "#j-pro" ).justFormsPro({
        rules: {
          rental_type: {
            required: true
          },
          _trip_vehicle_type: {
            required: true
          },
          email: {
            required: true,
            email: true
          },
          phone: {
            required: true
          },
          adults: {
            required: true,
            integer: true,
            minvalue: 0
          },
          children: {
            required: true,
            integer: true,
            minvalue: 0
          },
          date_from: {
            required: true
          },
          date_to: {
            required: true
          },
          message: {
            required: true
          }
        },
        messages: {
          name: {
            required: "Add your name"
          },
          email: {
            required: "Add your email",
            email: "Incorrect email format"
          },
          phone: {
            required: "Add your phone"
          },
          adults: {
            required: "Field is required",
            integer: "Only integer allowed",
            minvalue: "Value not less than 0"
          },
          children: {
            required: "Field is required",
            integer: "Only integer allowed",
            minvalue: "Value not less than 0"
          },
          date_from: {
            required: "Select check-in date"
          },
          date_to: {
            required: "Select check-out date"
          },
          message: {
            required: "Enter your message"
          }
        },
        formType: {
          multistep: true
        },
        afterSubmitHandler: function() {
          // Destroy date range
          destroyDate("#date_from");
          destroyDate("#date_to");

          // Initialize date range
          dateFrom("#date_from", "#date_to");
          dateTo("#date_from", "#date_to");

          return true;
        }
      });*/

      $( "#j-pro" ).justFormsPro({
        rules: {
          rental_type: {
            required: true
          },
          _trip_vehicle_type: {
            required: true
          },
          _inside_trip_start:{
            required: true
          },
          _inside_trip_end:{
            required: true
          },
          _inside_trip_start_date:{
            required: true
          },
          _inside_trip_duration:{
            required:true
          },
          _outside_trip_origin:{
            required: true
          },
          _outside_trip_end:{
            required: true
          },
          _outside_trip_start_date:{
            required: true
          },
          _outside_trip_end_date:{
            required: true
          },
          _traveller_first_name:{
            required:true
          },
          traveller_last_name:{
            required:true
          },
          traveller_email:{
            required:true
          },
          _traveller_phone:{
            required:true
          },
        },
        messages: {
          rental_type: {
            required: "Rental type is required"
          },
          _trip_vehicle_type: {
            required: "Vehicle type is required",
          },
          _inside_trip_start: {
            required: "Inside valley trip start destination is required",
          },
          _inside_trip_end: {
            required: "Inside valley trip end destination is required",
          },
          _inside_trip_start_date:{
            required:"Inside valley trip start date is required",
          },
          _inside_trip_duration:{
            required:"Inside valley trip duration is required",
          },
          _outside_trip_origin: {
            required: "Outside valley trip start destination is required",
          },
          _outside_trip_end: {
            required: "Outside valley trip end destination is required",
          },
          _outside_trip_start_date:{
            required:"Outside valley trip start date is required",
          },
          _outside_trip_end_date:{
            required:"Outside valley trip end date is required",
          },
          _traveller_first_name:{
            required:"Traveller first name is required",
          },
          traveller_last_name:{
            required:"Traveller last name is required",
          },
          traveller_email:{
            required:"Traveller email address is required",
          },
          _traveller_phone:{
            required:"Traveller phone is required",
          },
        },
        formType: {
          multistep: true
        },
        afterSubmitHandler: function() {
          // Destroy date range
          destroyDate("#date_from");
          destroyDate("#date_to");

          // Initialize date range
          dateFrom("#date_from", "#date_to");
          dateTo("#date_from", "#date_to");

          return true;
        }
      });
    });