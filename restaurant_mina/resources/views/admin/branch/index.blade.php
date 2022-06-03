@extends('admin.layouts.master')
@section('page_title','Mina Branches')
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
                                <h2>Branches</h2>
                            </div>
                            <div class="col-md-5">
                                <div class="add-new-branch add-new-vehicle">
                                    <a href="#" class="btn-green border-radius-30">add New</a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-block">
                    <div class="table-responsive dt-responsive">
                        <table class="table table-striped table-bordered data-table branch_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Jp name</th>
                                    <th>Phone</th>
                                    <th>Main branch</th>
                                    <th>Description</th>
                                    <th>Jp description</th>
                                    <th>status</th>
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
<!-- end single-page -->

<div class="modal fade" id="addNewBranch">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add New Branch</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

            <form id="branchForm" name="add_new_branch_form">
                @csrf
				<div class="modal-body branch_add_body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="branch_name">Branch Name</label>
                                <input type="text" class="form-control" name="branch_name" id="branch_name" placeholder="Norimatsu">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jp_branch_name">Branch japanese name</label>
                                <input type="text" name="jp_branch_name" id="jp_branch_name" placeholder="則松店" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" placeholder="093-692-8144" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="branch_email">Email</label>
                                <input type="email" name="email" id="email" placeholder="norimastu@indianrestaurantmina.com" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                             <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" selected="selected">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                             <div class="form-group">
                                <label>Is main branch</label>
                                <select name="is_main_branch" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0" selected="selected">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Japanese description</label>
                                <textarea class="form-control" name="jp_description" id="jp_description"></textarea>
                            </div>
                        </div>
                    </div>   
                </div>
                <div class="modal-footer">
                    <button type="submit" name="btnSubmit" class="btn btn-green">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
                <input type="hidden" name="branch_id" id="branch_id" value=""/>
			</form>
		</div>
	</div>
</div>
@endsection
@section('page_specific_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/es6-shim/0.35.3/es6-shim.min.js"></script>
    <script src="{{asset('admin-assets/formvalidation/dist/js/FormValidation.min.js')}}"></script>
    <script src="{{asset('admin-assets/formvalidation/dist/js/plugins/Bootstrap.min.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/htwjojrmzrtocohmg23pftvkzb8dn907vrzqzfeju23jhzf6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        var save_method;
        var branchTable;
        var branchId;
        var branch_url;
        initTinyMce();
        var form = document.getElementById('branchForm');
        $(document).ready(function () {

            branchTable = $('.branch_table').DataTable({
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
                    searchPlaceholder     : "Search mina branch"
                },
            ajax                  : {
                url :"{{route('admin.branch.index')}}",
                type : "GET",

            },
            columns:[
                {
                    "data": "id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {"data": "en_name", "name": "en_name"},
                {"data": "jp_name", "name": "jp_name"},
                {"data": "phone", "name": "phone"},
                {
                    data: 'is_main_branch',
                    name: 'is_main_branch',
                    render: function (data, type, full, meta) {
                        return data == "1" ? "Yes" : "No";
                    }
                },
                {"data": "en_description",
                    render:function(data,type,full,meta){
                        return data;
                    },
                 "name": "en_description"
                },
                {"data": "jp_description",
                    render:function(data,type,full,meta){
                        return data;
                    },
                 "name": "jp_description"
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function (data, type, full, meta) {
                        return data == "1" ? "Active" : "Inactive";
                    }
                },
                {"data": "action", "name": "action"},

            ],
            "fnInitComplete": function(oSettings, json) {
                /*tool_tip();*/
            }

        });

        //add new branch modal show
         $('body').on('click', '.add-new-branch', function () {
            save_method = "add";
            $("#branch_id").val('');
            initTinyMce();
            $('#addNewBranch').modal('show');
            });         
        //edit branch button click
        $('body').on('click','.edit-btn',function(e){
            //prevent the default action
            e.preventDefault();
            //make the save method
            save_method="udpate";
            //need to pouplate the data in the field by fetching the data from the server
            branchId = $(this).data('branch-id');
            $("#branch_id").val(branchId);
            branch_url   = "{{url('/admin/branches/')}}" + "/" + branchId + "/edit";
            $.get(branch_url ,function(response){
                //call the function to populate the data
                if(response.status == "success"){
                    initTinyMce();
                    populateModalData(response);
                    $("#addNewBranch").modal('show');
                }else{
                    //show the swal message
                    swal('Not found!!', 'Branch not found in the server', 'error');
                }
            });
        });

         const fv = FormValidation.formValidation(
        form,
        {
            fields: {
                branch_name:{
                    validators:{
                        notEmpty:{
                            message: "Branch name is required",
                        },
                    }
                },
                jp_branch_name: {
                    validators: {
                        notEmpty: {
                            message: 'The branch jp name is required'
                        },
                    }
                },
                phone: {
                   validators: {
                        notEmpty: {
                            message: 'The phone is required'
                        },
                    }
                },
                email: {
                   validators: {
                        notEmpty: {
                            message: 'The email is required'
                        },
                    }
                },
                status: {
                    validateField: {}
                },
                is_main_branch: {
                    validateField: {}
                },
                description: {
                    validateField: {}
                },
                jp_description: {
                    validateField: {}
                }
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                submitButton: new FormValidation.plugins.SubmitButton(),
                //defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                // Support the form made in Bootstrap 4
                bootstrap: new FormValidation.plugins.Bootstrap(),
                // Show the feedback icons taken from FontAwesome
                icon: new FormValidation.plugins.Icon({
                    valid: 'fa fa-check',
                    invalid: 'fa fa-times',
                    validating: 'fa fa-refresh',
                }),
            },

        }).on('core.form.valid', function () {
            branchId = $("#branch_id").val();
            if (save_method = 'update') {
                branch_url = "{{route('admin.branch.update',':branch')}}";
                branch_url = branch_url.replace(":branch",branchId);
            } else {
                branch_url = "{{route('admin.branch.store')}}";
            }
            // get the input values
            result = new FormData($(form)[0]);
            $.ajax({
                url: branch_url,
                data: result,
                dataType: "Json",
                contentType: false,
                processData: false,
                type: "POST",
                success: function (data) {
                    if(data.status == "success"){
                        $('#addNewBranch').modal('hide');
                        swal({
                            title: data.title,
                            text: data.message,
                            icon: "success",
                            button: "OK",
                        }).then(function () {
                            branchTable.ajax.reload();
                        });
                    }else{
                        swal({
                            title: data.title,
                            text: data.message,
                            icon: "error",
                            button: "OK"
                        })
                    }

                },
                error: function (jqXHR,textStatus,errorThrown) {
                    if(jqXHR.status == 500){
                        console.log('There is server error adding the new branch, please try again');
                    }
                }

            });
        });

        $('.modal').on('hidden.bs.modal', function(){
            $(form)[0].reset();
            fv.resetForm(true);
            tinymce.EditorManager.editors = [];
            $("h5.modal-title").html('Add new branch')
            $("#description").text('');
            $("#jp_description").text('');
        });

        $("body").on('click','.delete-btn', function(e){
        e.preventDefault();
        branchId=$(this).attr('data-branch-id');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover branch!",
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
                    url: "{{URL::to('admin/branches/')}}" + "/" + branchId,
                    type: "DELETE",
                    dataType: "Json",
                    context:this,
                    data: {_token: "{{csrf_token()}}"},
                    success: function (data) {
                        if (data.status == "success") {
                            swal(data.title, data.message, "success").then(function () {
                                branchTable.ajax.reload();

                            });
                        } else {
                            swal('Not allowed!!', data.message, 'error');
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        if (jqXHR.status == '404') {
                            swal('Not found in server', 'Branch does not exists', 'error');
                        } else if (jqXHR.status == '201') {
                            swal('Not allowed!!', 'Branch cannot be deleted.', 'error');
                        }
                    }
                });
            }
        });
    });
    });
    function initTinyMce(){
        tinymce.init({
                    selector: '#description,#jp_description',
                    plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
                    toolbar: 'insert undo redo formatselect bold italic backcolor  alignleft aligncenter alignright alignjustify bullist numlist outdent indent removeformat help',
                    toolbar_mode: 'floating',
                    tinycomments_mode: 'embedded',
                    tinycomments_author: 'Author name',
            });
    }



      //function to populate the modal data while the modal open in case of the edit product option
    function populateModalData(response,has_set_menu_image){
        //change the modal heading
        $("h5.modal-title").html('Update ' + response.branch[0].en_name + ' branch')
        //populate the individual field
        $("#branch_name").val(response.branch[0].en_name)
        $("#jp_branch_name").val(response.branch[0].jp_name)
        $("#phone").val(response.branch[0].phone)
        $("#email").val(response.branch[0].email)
        //loop through each status
        var food_status = $("select[name='status'] > option")
        food_status.each((index,value) =>{
            if(response.branch[0].status == value.value){
                $("select[name='status']").val(response.branch[0].status)
            }
        })
        //loop through each of the main branch
        var is_main_branch = $("select[name='is_main_branch'] > option")
        is_main_branch.each((index,value) =>{
            if(response.branch[0].is_main_branch == value.value){
                $("select[name='is_main_branch']").val(response.branch[0].is_main_branch)
            }
        })

        //set the content in the tinymce
        if(response.branch[0].en_description != null)
            tinymce.get('description').setContent(response.branch[0].en_description);
        if(response.branch[0].jp_description != null)
            tinymce.get("jp_description").setContent(response.branch[0].jp_description);
    }
</script>
@endsection