@extends('admin.layouts.master')
@section('page_title','Mina Menu Type')
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
                                <h2>Menus</h2>
                            </div>
                            <div class="col-md-5">
                                <div class="add-new-menu add-new-vehicle">
                                    <a href="#" class="btn-green border-radius-30">add New</a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-block">
                    <div class="table-responsive dt-responsive">
                        <table class="table table-striped table-bordered data-table category_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Jp Name</th>
                                    <th>Parent</th>
                                    <th>No of Foods</th>
                                    <th>Order</th>
                                    <th>Description</th>
                                    <th>Jp Description</th>
                                    <th>status</th>
                                    <th>Show / Hide </th>
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

<div class="modal fade" id="add-new-menu-modal">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add New Menu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

            <form id="categoryForm" name="category_form">
                @csrf
				<div class="modal-body category_add_body">
                     <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="food_number">Name</label>
                                <input type="text" class="form-control" name="category_name" id="category_name" placeholder="lunch">
                            </div>
                            <div class="form-group">
                                <label for="food_name">Japanese Name</label>
                                <input type="text" name="jp_category_name" id="jp_category_name" placeholder="カレー" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="jp_food_name">Parent</label>
                                <select name="parent_category_id" class="form-control">
                                    <option value="0" disabled="disabled" selected="selected">None</option>
                                    @foreach($menus->where('parent',0) as $menu)
                                    <option value="{{$menu->id}}">{{$menu->en_name}}</option>
                                    @endforeach
                                </select>
                            </div>
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
                                <label>Upload Image</label>
                                <div class="file-upload">
                                    <div class="image-upload-wrap"  style="background: url({{asset('/admin-assets/images/foods/prawn_green_asparagus_curry.jpg')}});background-size: contain;">
                                        <img src="{{asset('/admin-assets/images/foods/prawn_green_asparagus_curry.jpg')}}" class="img-fluid image-preview-single">
                                        <input class="file-upload-input" type="file" name="category_image_path" onchange="previewFile(this);" accept="image/*">
                                        <div class="drag-text">
                                            <div class="icon">+</div>
                                        </div>
                                    </div>
                                    <div class="file-upload-content">
                                        <img class="file-upload-image img-fluid" src="#" alt="your image">
                                        <div class="image-title-wrap">
                                            <button type="button" onclick="removeUpload()" class="remove-image btn-blue">Remove Image<span class="image-title">Uploaded Image</span></button>
                                        </div>
                                    </div>
                                </div>
                                <button class="file-upload-btn  btn-blue" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Select Image
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Show in Frontend Menu</label>
                                <select name="show_in_nav" class="form-control">
                                    <option value="1" selected="selected">Show</option>
                                    <option value="0">Hide</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Menu order</label>
                                <select name="order" class="form-control">
                                    <option value="10" selected="selected">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="30">30</option>
                                    <option value="35">35</option>
                                    <option value="40">40</option>
                                    <option value="45">45</option>
                                    <option value="50">50</option>
                                    <option value="55">55</option>
                                    <option value="60">60</option>
                                    <option value="65">65</option>
                                    <option value="70">70</option>
                                    <option value="75">75</option>
                                    <option value="80">80</option>
                                    <option value="85">85</option>
                                    <option value="90">90</option>
                                    <option value="95">95</option>
                                    <option value="100">100</option>
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
                <input type="hidden" name="category_id" id="category_id" value=""/>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/es6-shim/0.35.3/es6-shim.min.js"></script>
    <script src="{{asset('admin-assets/formvalidation/dist/js/FormValidation.min.js')}}"></script>
    <script src="{{asset('admin-assets/formvalidation/dist/js/plugins/Bootstrap.min.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/htwjojrmzrtocohmg23pftvkzb8dn907vrzqzfeju23jhzf6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        $(document).ready(function () {
            //intialize the variables
            var save_method = "add";
            var menu_url;
            var categoryTable;
            var categoryId;
            var form = document.getElementById('categoryForm');
            //intialize the tinymce editor
            initTinyMce();
            //render the data in the datatable based on the fetched results
            categoryTable = $('.category_table').DataTable({
                dom: 'Blfrtip',
                buttons: [],
                order: [[0,'desc']],
                autoWidth: false,
                order: [[0, "asc"]],
                searching:true,
                pageLength: "10",
                destroy: true,
                processing: true,
                serverSide: true,
                language              : {
                    searchPlaceholder     : "Search mina menu"
                },
                ajax                  : {
                    url :"{{route('admin.menu.index')}}",
                    type : "GET",

                },
                columns:[
                    {
                        "data": "id",
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {'render'  :function(data, type, JsonResultRow, meta)
                        {
                            return "<img src='"+ JsonResultRow.image_path + "' height='100px' width='200px'>";
                        }
                    },
                    {"data": "en_name", "name": "en_name"},
                    {"data": "jp_name", "name": "jp_name"},
                    {
                        data: 'parent',
                        name: 'parent',
                    },
                    {"data": "total_foods", "name": "total_foods"},
                    {"data": "order", "name": "order"},
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
                    {
                        data: 'show_in_nav',
                        name: 'show_in_nav',
                        render: function (data, type, full, meta) {
                            return data == "1" ? "Show" : "Hide";
                        }
                    },
                    {"data": "action", "name": "action"},

                ],
                "fnInitComplete": function(oSettings, json) {
                    /*tool_tip();*/
                }

            });
            //end of the datatable data rendering
            const fv = FormValidation.formValidation(
            form,
            {
                fields: {
                    category_name: {
                        validators: {
                            notEmpty: {
                                message: 'The menu name is required'
                            },
                        }
                    },
                    jp_category_name: {
                        validateField: {}

                    },
                    parent_category_id: {
                        validateField: {}

                    },
                    status: {
                        validateField: {}

                    },
                    show_in_nav: {
                        validateField: {}

                    },
                    description: {
                        validateField: {}
                    },
                    jp_description: {
                        validateField: {}
                    },
                    category_image_path: {
                        validators: {
                            file: {
                                extension: 'jpeg,jpg,png',
                                type: 'image/jpeg,image/png',
                                maxSize: 2097152,   // 2048 * 1024
                                message: 'You cannot upload the image that is greater than 2MB size'
                            }
                        }
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
                categoryId = $("#category_id").val();
                if (save_method = 'update') {
                    menu_url = "{{route('admin.menu.update',':menu')}}";
                    menu_url = menu_url.replace(":menu",categoryId);
                } else {
                    menu_url = "{{route('admin.menu.store')}}";
                }
                // get the input values
                result = new FormData($(form)[0]);
                $.ajax({
                    url: menu_url,
                    data: result,
                    dataType: "Json",
                    contentType: false,
                    processData: false,
                    type: "POST",
                    success: function (data) {
                        if(data.status == "success"){
                            $('#add-new-menu-modal').modal('hide');
                            swal({
                                title: data.title,
                                text: data.message,
                                icon: "success",
                                button: "OK",
                            }).then(function () {
                                categoryTable.ajax.reload();
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
                            console.log('There is server error adding the new menu, please try again');
                        }
                    }

                });
            });
            //add new menu
            $('body').on('click', '.add-new-menu', function () {
                save_method = "add";
                $("#category_id").val('');
                initTinyMce();
                $('#add-new-menu-modal').modal('show');
            });

            //edit menu button click
            $('body').on('click','.edit-btn',function(e){
                //prevent the default action
                e.preventDefault();
                //make the save method
                save_method="udpate";
                //need to pouplate the data in the field by fetching the data from the server
                categoryId = $(this).data('menu-id');
                $("#category_id").val(categoryId);
                menu_url   = "{{url('/admin/menus/')}}" + "/" + categoryId + "/edit";
                $.get(menu_url ,function(response){
                    //call the function to populate the data
                    if(response.status == "success"){
                        initTinyMce();
                        populateModalData(response);
                        $("#add-new-menu-modal").modal('show');
                    }else{
                        //show the swal message
                        swal('Not found!!', 'Menu not found in the server', 'error');
                    }
                });
            });

            //reset the validation when the image was removed
            $('body').on('click','.remove-image',function(e){
                e.preventDefault();
                console.log('hello i need to revalidate the image');
                //reset the form validation field
                fv.resetField('category_image_path');
            });
            //delete the menu
            $("body").on('click','.delete-btn', function(e){
                e.preventDefault();
                categoryId=$(this).attr('data-menu-id');
                menu_url  = "{{url('/admin/menus/')}}" + "/" + categoryId;
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover menu!",
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
                            url: menu_url,
                            type: "DELETE",
                            dataType: "Json",
                            context:this,
                            data: {_token: "{{csrf_token()}}"},
                            success: function (data) {
                                if (data.status == "success") {
                                    swal(data.title, data.message, "success").then(function () {
                                        categoryTable.ajax.reload();

                                    });
                                } else {
                                    swal('Not allowed!!', data.message, 'error');
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                if (jqXHR.status == '404') {
                                    swal('Not found in server', 'The menu does not exists', 'error');
                                } else if (jqXHR.status == '201') {
                                    swal('Not allowed!!', 'The menu cannot be deleted. Please try again later', 'error');
                                }
                            }
                        });
                    }
                });
            });
            $('.modal').on('hidden.bs.modal', function(){
                //reset the form, form validation and the editor
                $(form)[0].reset();
                removeUpload();
                fv.resetForm(true);
                tinymce.EditorManager.editors = []; 
                $("#description").text('');
                $("#jp_description").text('');
                showDefaultImage();
            });
            $.fn.dataTable.ext.errMode = 'none';
        });


        // function re reinitialize the tinymce while destoryed when the modal close
        function initTinyMce(){
            tinymce.init({
                    selector: 'textarea',
                    plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
                    toolbar: 'insert undo redo formatselect bold italic backcolor  alignleft aligncenter alignright alignjustify bullist numlist outdent indent removeformat help',
                    toolbar_mode: 'floating',
                    tinycomments_mode: 'embedded',
                    tinycomments_author: 'Author name',
            });

        }


        //function to populate the modal data while the modal open in case of the edit menu option
        function populateModalData(response,has_set_menu_image){
            //change the modal heading
            $("h5.modal-title").html('Update ' + response.menu.en_name + ' menu')
            //populate the individual field
            $("#category_name").val(response.menu.en_name)
            $("#jp_category_name").val(response.menu.jp_name)
            //make the parent category selected
            var parent_category_options = $("select[name='parent_category_id'] > option");
            parent_category_options.each((index,value)=>{
                if(response.menu.parent == value.value){
                    $("select[name='parent_category_id']").val(response.menu.parent)
                }
            })
            //loop through each 
            var menu_status = $("select[name='status'] > option")
            menu_status.each((index,value) =>{
                if(response.menu.status == value.value){
                    $("select[name='status']").val(response.menu.status)
                }
            })

            var menu_status = $("select[name='show_in_nav'] > option")
            menu_status.each((index,value) =>{
                if(response.menu.show_in_nav == value.value){
                    $("select[name='show_in_nav']").val(response.menu.show_in_nav)
                }
            })

            var menu_order = $("select[name='order'] > option")
            menu_order.each((index,value) =>{
                if(response.menu.order == value.value){
                    $("select[name='order']").val(response.menu.order)
                }
            })
            //set the content in the tinymce
            if(response.menu.en_description != null)
                tinymce.get('description').setContent(response.menu.en_description);
            if(response.menu.jp_description != null)
                tinymce.get("jp_description").setContent(response.menu.jp_description);

            //set the if provided
            if(response.menu.image_path != null){
                var image_directory = "{{asset('/uploads/menus/large')}}";
                $(".image-preview-single").attr('src',image_directory + "/" + response.menu.image_path);
            }
        }


        function showDefaultImage(){
            var default_image_path = "{{asset('/admin-assets/images/foods/prawn_green_asparagus_curry.jpg')}}";
            $('.image-preview-single').attr('src',default_image_path);
        }

</script>
@endsection