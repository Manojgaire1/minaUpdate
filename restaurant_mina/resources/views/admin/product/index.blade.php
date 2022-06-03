@extends('admin.layouts.master')
@section('page_title','Mina Food List')
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
                                    <h2>Foods</h2>
                                </div>
                                <div class="col-md-5">
                                    <div class="add-new-branch add-new-product add-new-vehicle">
                                        <a href="#" class="btn-green border-radius-30">add New</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-block">
                            <div class="table-responsive dt-responsive">
                                <table class="table table-striped table-bordered data-table product_table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Jp name</th>
                                            <th>Price</th>
                                            <th>Menu</th>
                                            <th>Type</th>
                                            <th>Takeout</th>
                                            <th>Description</th>
                                            <th>Jp description</th>
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
                 </div><!-- end page -->
            </div>
        </div>
    </div>
</div>
<!-- end single-page -->

<div class="modal fade" id="add-new-food">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add New Food</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

            <form id="foodForm" name="food_form">
                @csrf
				<div class="modal-body food_body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="food_number">Food Number</label>
                                <input type="number" class="form-control" name="food_number" id="food_number" placeholder="200">
                            </div>
                            <div class="form-group">
                                <label for="food_name">Food Name</label>
                                <input type="text" name="food_name" id="food_name" placeholder="Chicken tandoori" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="jp_food_name">Food Japanese name</label>
                                <input type="text" name="jp_food_name" id="jp_food_name" placeholder="タンドリーチキン" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="food_name">Menu</label>
                                <select name="category_id" class="form-control">
                                    <option value="" disabled="disabled" selected="selected">Choose Menu</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{ucwords($category->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Upload Image</label>
                                <div class="file-upload">
                                    <div class="image-upload-wrap"  style="background: url({{asset('/admin-assets/images/foods/prawn_green_asparagus_curry.jpg')}});background-size: contain;">
                                        <img src="{{asset('/admin-assets/images/foods/prawn_green_asparagus_curry.jpg')}}" class="img-fluid image-preview-single">
                                        <input class="file-upload-input" type="file" name="image_path" onchange="previewFile(this);" accept="image/*">
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
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" selected="selected">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                             <div class="form-group">
                                <label>Available for Takeout</label>
                                <select name="is_takeout" class="form-control">
                                    <option value="1" selected="selected">Available</option>
                                    <option value="0">Not available</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                             <div class="form-group">
                                <label>Product Type<span class="text-muted"> (Choose variable if have many pcs)</span></label>
                                <select name="product_type" class="form-control">
                                    <option value="simple" selected="selected">Simple</option>
                                    <option value="variable">Variable</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 simple_price">
                            <div class="form-group">
                                <label for="product_price">Price</label>
                                <input type="number" name="price" class="form-control" id="simple_food_price" placeholder="200" />
                            </div>
                        </div>
                    </div>
                    <div class="row variable_price variable_attribute">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="price">Product number</label>
                                    <input type="number" name="variable_product_number[]" class="form-control" placeholder="38" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bbq_pcs">BBQ pcs</label>
                                <select name="bbq_pcs[]" class="form-control">
                                    <option value="1pc" selected="selected">1 pc</option>
                                    <option value="2pcs">2pcs</option>
                                    <option value="4pcs">4pcs</option>
                                    <option value="8pcs">8pcs</option>
                                    <option value="full">Full</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="price">Price</label>
                                    <input type="number" name="variable_price[]" class="form-control" placeholder="200" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row variable_price_add_btn variable_attribute">
                        <div class="col-md-12">
                            <div class="add-item">
                                <div class="add">+
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="is_available_for_change">Available for change</label>
                                <select name="__is_available_for_change" class="form-control" id="__is_available_for_change">
                                    <option value="0" selected="selected">Not available</option>
                                    <option value="1">Available</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="__change_price_container">
                                <div class="form-group">
                                    <label for="change_price">Change Price</label>
                                    <input type="number" name="__change_price" id="__change_price" class="form-control" placeholder="0">
                                </div>
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
                    <input type="hidden" name="product_id" id="product_id" value=""/>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/es6-shim/0.35.3/es6-shim.min.js"></script>
<script src="{{asset('admin-assets/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('admin-assets/formvalidation/dist/js/plugins/Bootstrap.min.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.tiny.cloud/1/htwjojrmzrtocohmg23pftvkzb8dn907vrzqzfeju23jhzf6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
$(document).ready(function () {
    var save_method = "add";
    var productTable;
    var form = document.getElementById('foodForm');
    initTinyMce();
    $('.variable_attribute').hide();
    $('.__change_price_container').hide();
       productTable = $('.product_table').DataTable({
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
                searchPlaceholder     : "Search mina product"
            },
            ajax                  : {
                url :"{{route('admin.product.index')}}",
                type : "GET",

            },
            columns:[
                {
                    "data": "number",
                    // render: function (data, type, row, meta) {
                    //     return meta.row + meta.settings._iDisplayStart + 1;
                    // }
                    "name" : "number"
                },
                {'render'  :function(data, type, JsonResultRow, meta)
                    {
                        return "<img src='"+ JsonResultRow.image_path + "' height='100px' width='200px'>";
                    }
                },
                {"data": "en_name", "name": "en_name"},
                {"data": "jp_name", "name": "jp_name"},
                {"data": "price", "name": "price"},
                {"data": 'category',"name": 'category'},
                {"data": "type", "name": "type"},
                {"data": "is_open_for_takeout",
                    render:function(data,type,full,meta){
                        return data == "1" ? "Yes" : "No";
                    },
                 "name": "is_open_for_takeout"
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
                    "data": 'status',
                    "name": 'status',
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

        const fv = FormValidation.formValidation(
        form,
        {
            fields: {
                food_number:{
                    validators:{
                        notEmpty:{
                            message: "Food number is required",
                        },
                        integer:{
                            message: "Food number can be number only"
                        },
                        stringLength:{
                            max: 6,
                            message: "Food number cannot be greater than 6 digits"
                        }
                    }
                },
                food_name: {
                    validators: {
                        notEmpty: {
                            message: 'The food name is required'
                        },
                    }
                },
                jp_food_name: {
                    validateField: {}

                },
                category_id: {
                    validators: {
                        notEmpty: {
                            message: 'Select the food menu'
                        },
                    }

                },
                status: {
                    validateField: {}

                },
                is_takeout: {
                    validateField: {}

                },
                product_type:{
                    validateField:{}
                },
                description: {
                    validateField: {}
                },
                jp_description: {
                    validateField: {}
                },
                price:{
                    validators:{
                        notEmpty:{
                            enabled: true,
                            message: "Food price is required"
                        }
                    }
                },
                 __change_price:{
                    validators:{
                        // notEmpty:{
                        //     enabled: true,
                        //     message: "Change with service naan price is required"
                        // }
                    }
                },
                image_path: {
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
            productId = $("#product_id").val();
            if (save_method = 'update') {
                product_url = "{{route('admin.product.update',':product')}}";
                product_url = product_url.replace(":product",productId);
            } else {
                product_url = "{{route('admin.product.store')}}";
            }
            // get the input values
            result = new FormData($(form)[0]);
            $.ajax({
                url: product_url,
                data: result,
                dataType: "Json",
                contentType: false,
                processData: false,
                type: "POST",
                success: function (data) {
                    if(data.status == "success"){
                        $('#add-new-food').modal('hide');
                        swal({
                            title: data.title,
                            text: data.message,
                            icon: "success",
                            button: "OK",
                        }).then(function () {
                            productTable.ajax.reload();
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
    $('body').on('click', '.add-new-product', function () {
        save_method = "add";
        $("#product_id").val('');
        initTinyMce();
        $('#add-new-food').modal('show');
    });

    //edit menu button click
    $('body').on('click','.edit-btn',function(e){
        //prevent the default action
        e.preventDefault();
        //make the save method
        save_method="udpate";
        //need to pouplate the data in the field by fetching the data from the server
        productId = $(this).data('product-id');
        $("#product_id").val(productId);
        product_url   = "{{url('/admin/products/')}}" + "/" + productId + "/edit";
        $.get(product_url ,function(response){
            //call the function to populate the data
            if(response.status == "success"){
                initTinyMce();
                populateModalData(response);
                $("#add-new-food").modal('show');
            }else{
                //show the swal message
                swal('Not found!!', 'Prdouct not found in the server', 'error');
            }
        });
    });

    $("body").on('click','.delete-btn', function(e){
        e.preventDefault();
        productId=$(this).attr('data-product-id');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover product!",
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
                    url: "{{URL::to('admin/products/')}}" + "/" + productId,
                    type: "DELETE",
                    dataType: "Json",
                    context:this,
                    data: {_token: "{{csrf_token()}}"},
                    success: function (data) {
                        if (data.status == "success") {
                            swal(data.title, data.message, "success").then(function () {
                                productTable.ajax.reload();

                            });
                        } else {
                            swal('Not allowed!!', data.message, 'error');
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        if (jqXHR.status == '404') {
                            swal('Not found in server', 'Product does not exists', 'error');
                        } else if (jqXHR.status == '201') {
                            swal('Not allowed!!', 'Product cannot be deleted.', 'error');
                        }
                    }
                });
            }
        });
    });

    //show the vaiable attribute when variable product is selected
    $('body').on('change','select[name="product_type"]',function(e){
        //prevent the default action
        e.preventDefault();
        if($(this).val() == "variable"){
            $('.variable_attribute').show();
            $('.simple_price').hide();
             fv.disableValidator('price');
        }else{
            $('.variable_attribute').hide();
            $('.simple_price').show();
            fv.enableValidator('price');
        }
    });

    //show the vaiable attribute when variable product is selected
    $('body').on('change','#__is_available_for_change',function(e){
        //prevent the default action
        e.preventDefault();
        if($(this).val() == "1"){
            $('.__change_price_container').show();
            //fv.enableValidator('__change_price');
        }else{
            $('.__change_price_container').hide();
            //fv.disableValidator('__change_price');
        }
    });

    $('body').on('click','.variable_price_add_btn',function(e){
        //prevent the default action
        e.preventDefault();
        addVariationAttribute();
    });
    $('body').on('click','.remove-item',function(e){
        //prevent the default action
        e.preventDefault();
        $(this).parent().closest('div.variable_price').remove();
    });

    $('.modal').on('hidden.bs.modal', function(){
        $(form)[0].reset();
        removeUpload();
        fv.resetForm(true);
        tinymce.EditorManager.editors = [];
        $("h5.modal-title").html('Add new food')
        $("#description").text('');
        $("#jp_description").text('');
        $('.added_attribute').remove();
        $('.variable_attribute').hide();
        $('.__change_price_container').hide();
        $('.__change_price').val('');
        $('.simple_price').show();
        showDefaultImage();
    });
    $.fn.dataTable.ext.errMode = 'none';
});

    //function to add the dyanmic field for the variable product
    function addVariationAttribute(bbq_pcs=null,price=0,variable_product_number){
        var html = "";
        html += ' <div class="row variable_price variable_attribute added_attribute"><div class="col-md-4"><div class="row"><div class="col-sm-12"><label for="price">Product number</label><input type="number" name="variable_product_number[]" class="form-control" placeholder="38" value="'
        if(variable_product_number != null)
            html += variable_product_number
        html += '" /></div></div></div><div class="col-md-4 parent_container"><div class="form-group"><label for="bbq_pcs">BBQ pcs</label><select name="bbq_pcs[]" class="form-control">';
        html += '<option value="1pc"';
        if((bbq_pcs != null && bbq_pcs == "1pc") || bbq_pcs == null)
            html += 'selected="selected"';
        html += '>1 pc</option>';
        html += '<option value="2pcs"';
        if(bbq_pcs != null && bbq_pcs == "2pcs")
            html += 'selected="selected"';
        html += '>2pcs</option>';
        html += '<option value="4pcs"';
        if(bbq_pcs != null && bbq_pcs == "4pcs")
            html += 'selected="selected"';
        html += '>4pcs</option>';
        html += '<option value="8pcs"';
        if(bbq_pcs != null && bbq_pcs == "8pcs")
            html += 'selected="selected"';
        html += '>8pcs</option>';
        html += '<option value="full"';
        if(bbq_pcs != null && bbq_pcs == "full")
            html += 'selected="selected"';
        html += '>Full</option>';
        html += '</select></div></div><div class="col-md-4">';
        html += '<div class="row"><div class="col-sm-10"><label for="price">Price</label><input type="number" name="variable_price[]" class="form-control" placeholder="200" value="';
        if(price > 0)
            html += price + '"/>';
        else
            html += '"/>';
        html += '</div><div class="col-sm-1"><div class="remove-item"><div class="minus">-</div></div></div></div></div></div>';
        $(".variable_price:last").after(html);
    }

    //function to initialize the tinymce
    // function re reinitialize the tinymce while destoryed when the modal close
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
        $("h5.modal-title").html('Update ' + response.product[0].en_name + ' food')
        //populate the individual field
        $("#food_number").val(response.product[0].number)
        $("#food_name").val(response.product[0].en_name)
        $("#jp_food_name").val(response.product[0].jp_name)
        //make the parent category selected
        var category_options = $("select[name='category_id'] > option");
        category_options.each((index,value)=>{
            if(response.product[0].category_id == value.value){
                $("select[name='category_id']").val(response.product[0].category_id)
            }
        })
        //loop through each 
        var food_status = $("select[name='status'] > option")
        food_status.each((index,value) =>{
            if(response.product[0].status == value.value){
                $("select[name='status']").val(response.product[0].status)
            }
        })

        var food_for_takeout = $("select[name='is_takeout'] > option")
        food_for_takeout.each((index,value) =>{
            if(response.product[0].is_open_for_takeout == value.value){
                $("select[name='is_takeout']").val(response.product[0].is_open_for_takeout)
            }
        })

        var food_for_change = $("select[name='__is_available_for_change'] > option")
        food_for_change.each((index,value) =>{
            if(response.product[0].is_available_for_change == value.value){
                $("select[name='__is_available_for_change']").val(response.product[0].is_available_for_change)
            }
        })
        //set the content in the tinymce
        if(response.product[0].en_description != null)
            tinymce.get('description').setContent(response.product[0].en_description);
        if(response.product[0].jp_description != null)
            tinymce.get("jp_description").setContent(response.product[0].jp_description);

        //set the if provided
        if(response.product[0].images.length > 0){
            if(response.product[0].images[0].image_path != null){
                var image_directory = "{{asset('/uploads/products/large')}}";
                $(".image-preview-single").attr('src',image_directory + "/" + response.product[0].images[0].image_path);
            }
        }

        if(response.product[0].is_available_for_change == "1"){
            $("#__change_price").val(response.product[0].product_details[0].change_price)
            $(".__change_price_container").show()
        }
        //need to populate the price
        if(response.product[0].type == "simple"){
            $('select[name="product_type"]').val("simple");
            $('#simple_food_price').val(response.product[0].product_details[0].price);
        }else{
            $('select[name="product_type"]').val("variable");
            updateVariablePrice(response);
        }
        //fire on change trigger
        $("select[name='product_type']").trigger('change');
    }

    //function to set the default image on the modal close
    function showDefaultImage(){
        var default_image_path = "{{asset('/admin-assets/images/foods/prawn_green_asparagus_curry.jpg')}}";
        $('.image-preview-single').attr('src',default_image_path);
    }

    //function to update the variable price
    function updateVariablePrice(response){
        //loop through each of the product variation
        var i = 0;
        $.each(response.product[0].product_details,function(index,value){
            //
            if(i == 0){
                $("select[name='bbq_pcs[]']").val(value.bbq_pcs);
                $("input[name='variable_price[]']").val(value.price);
                $("input[name='variable_product_number[]']").val(value.variable_product_number);
            }else{
                //need to add the variable field
                addVariationAttribute(value.bbq_pcs,value.price,value.variable_product_number);
            }
            i++;
        })
    }

</script>
@endsection