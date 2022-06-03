@extends('admin.layouts.master')
@section('page_title','Mina Reservations List')
@section('page_specific_css')
<link href="{{ asset('/admin-assets/formvalidation/dist/css/formValidation.min.css') }}" rel="stylesheet">
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
                                <h2>Reservations</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                    <div class="table-responsive dt-responsive">
                        <table class="table table-striped table-bordered data-table reservation_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer Fullname</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Date & Time</th>
                                    <th>Peoples</th>
                                    <th>Branch</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    </div>
					</div>
                </div>
                <!-- end page -->
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="udpate-reservation-status">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update reservation status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="reservationForm" name="reservation_update_form">
                @csrf
                <div class="modal-body reservation_form_body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="food_number">Status</label>
                                <select name="status" class="form-control">
                                    <option value="" disabled="disabled" selected="selected">Choose Status</option>
                                    <option value="0">Pending</option>
                                    <option value="1">Confirmed</option>
                                    <option value="2">Cancelled</option>
                                </select>
                            </div>
                            <div class="form-group cancelled_message">
                                <label for="cancelled_message">Cancelled Message</label>
                                <textarea name="cancelled_message" class="form-control" placeholder="cancelled message if any" rows="10" cols="10"></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="reservation_id" id="reservation_id" value=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="btnSubmit" class="btn btn-green">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('page_specific_js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
var reservationTable;
$(".cancelled_message").hide();
$(document).ready(function () {
        reservationTable = $('.reservation_table').DataTable({
            dom: 'Blfrtip',
            buttons: [],
            autoWidth: false,
            order: [[0, "asc"]],
            searching:true,
            pageLength: "10",
            destroy: true,
            processing: true,
            serverSide: true,
            language              : {
                searchPlaceholder     : "Search reservation"
            },
        ajax                  : {
            url :"{{route('admin.reservation.index')}}",
            type : "GET",

        },
        columns:[
                {
                    "data": "id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {"data": "customer_full_name", "name": "customer_full_name"},
                {"data": 'email',name: 'email'},
                {"data": "phone", "name": "phone"},
                {"data": "reservation_date_time","name": "reservation_date_time"},
                {"data": "no_of_peoples","name": "no_of_peoples"},
                {"data": "branch_name","name": "branch_name"},
                {"data": "message",
                    render:function(data,type,full,meta){
                        return data;
                    },
                 "name": "message"
                },
                {"data": "status","name": "status"},
                {"data": "action", "name": "action"},
            ],
        "fnInitComplete": function(oSettings, json) {
            /*tool_tip();*/
        }
    });
    $("body").on('click','.edit-btn', function(e){
        e.preventDefault();
        reservationId=$(this).attr('data-reservation-id');
        reservationStatus=$(this).attr('data-reservation-status');
        $("#reservation_id").val(reservationId);
        var menu_status = $("select[name='status'] > option")
        menu_status.each((index,value) =>{
            if(reservationStatus == value.value){
                $("select[name='status']").val(reservationStatus)
            }
        })
        //check the reservation status to show the cancelled message
        if(reservationStatus == 2){
            $(".cancelled_message").show();
        }
        $("#reservation_id").val(reservationId);
        $("#udpate-reservation-status").modal('show');
    });

    $("body").on('submit','#reservationForm', function(e){
        e.preventDefault();
        reservationId = $("#reservation_id").val();
        result = new FormData($(this)[0]);
        $.ajax({
            url: "{{url('/admin/reservations/')}}" + "/" + reservationId,
            data: result,
            dataType: "Json",
            contentType: false,
            processData: false,
            type: "POST",
            success: function (data) {
                $("#udpate-reservation-status").modal('hide');
                swal({
                    title: data.title,
                    text: data.message,
                    icon: "success",
                    button: "OK",
                }).then(function () {
                    reservationTable.ajax.reload();
                });

            },
            error: function (event) {
                $('body').find('#counter').val(0);
            }

        });
    });
    //show the hide the cancelled message as per the status selected
    $("body").on('change','select[name="status"]', function(e){
        if($(this).val() == 2){
            $(".cancelled_message").show();
        }else{
            $(".cancelled_message").hide();
        }
    });

    //delete the reservation
    $("body").on('click','.delete-btn', function(e){
        e.preventDefault();
        reservationId=$(this).attr('data-reservation-id');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover reservation!",
            icon: "warning",
            buttons: {
                cancel: "Cancel",
                catch: {
                    text: "Delete",
                    value: "catch",
                },
            },
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
        }).then(function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "{{URL::to('admin/reservations/')}}" + "/" + reservationId,
                    type: "DELETE",
                    dataType: "Json",
                    context:this,
                    data: {_token: "{{csrf_token()}}"},
                    success: function (data) {
                        if (data.status == "success") {
                            swal(data.title, data.message, "success").then(function () {
                                reservationTable.ajax.reload();

                            });
                        } else {
                            swal('Not allowed!!', data.message, 'error');
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        if (jqXHR.status == '404') {
                            swal('Not found in server', 'The vehicle type does not exists', 'error');
                        } else if (jqXHR.status == '201') {
                            swal('Not allowed!!', 'The vehicle type cannot be deleted.', 'error');
                        }
                    }
                });
            }
        });
    });
    $.fn.dataTable.ext.errMode = 'none';
});
</script>
@endsection