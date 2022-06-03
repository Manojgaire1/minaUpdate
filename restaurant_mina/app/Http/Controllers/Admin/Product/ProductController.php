<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductDetail;
use App\Models\ProductImage;
use Carbon\Carbon;

class ProductController extends AdminBaseController
{
    protected $selected_product;
    protected $product, $productDetail;
    protected $upload_image_dir = "uploads/products";
    /**
    *
    * constructor for product
    * @param product(object)
    *
    **/
    public function __construct(Product $product, ProductDetail $productDetail){
        $this->product = $product;
        $this->productDetail = $productDetail;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->ajax()):
            $products = Product::select('*')->with('productDetails')->orderBy('id','desc');
            return Datatables($products)
            ->addColumn('image_path',function($product){
                if($product->images()->count() > 0):
                    if($product->images()->first()->image_path != null):
                        return asset('/uploads/products/small'.'/'.$product->images()->first()->image_path);
                    endif;
                endif;
                    return asset('/admin-assets/images/foods/default_food_image.jpg');
            })
            ->addColumn('category',function($product){
                return $product->category->en_name;
            })
            ->addColumn('price',function($product){
                $product_price = $product->productDetails()->first();
                return $product_price->price;
            })
            ->addColumn('action', function ($product) {
                $return_html = '<div class="dropdown">' .
                    '<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ti-more-alt"></i></button>' .
                    '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" >' .
                    '<ul>' .
                    '<li><button class="dropdown-item edit-btn" data-product-id = "'.$product->id.'" href = "#" > Edit</button ></li >'.
                    '<li ><a class="dropdown-item delete-btn" href = "#" data-product-id = '.$product->id.' > Delete</a ></li >'.
                    '</ul >'.
                    '</div ></div >';

                return $return_html;

            })->rawColumns(['action','en_description','jp_description'])
            ->make();
        else:
            return view('admin.product.index')->with([
                'categories' => Category::where('status','1')->select('id','en_name')->get()
            ]);
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
        $data = $request->except("_token");
        //save the product in database
        $this->selected_product  = $this->product->addProduct($data);
        //upload product image if present
        $this->updateOrInsertProductImages($request);
        //need to store the product details
        $this->updateOrInsertProductDetails($request);
        //send the response back to the client
        if($this->selected_product):
            return response()->json(array('status' => 'success','message' => 'Food has been created successfully','title' => 'Successfully created'),200);
        else:
            return response()->json(array('status' => 'failed','message' => 'Food cannot be created, please try again','title' => 'Failed'),200);
        endif;
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
        $this->selected_product = $this->product::where('id',$id)->with('productDetails','images')->get();
        if($this->selected_product):
            return response()->json(array('status' => 'success', 'product' => $this->selected_product,'message' => 'Food has been fetched successfully!'),200);
        else:
            return response()->json(array('status' => 'failed','message' => 'Food does not exist in the server'),404);
        endif;
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
        $data = $request->except('_token');
        //update the record in the storage
        $this->selected_product  = $this->product->updateProduct($data,$id);
        //update the product image if present
        $this->updateOrInsertProductImages($request,$update=true);
        //need to update the product details
        $this->updateOrInsertProductDetails($request,$udpate=true);
        //send the response back to the client as per the db response
        if($this->selected_product):
            return response()->json(array('status' => 'success','message' => 'Food has been updated successfully','title' => 'Successfully updated'),200);
        else:
            return response()->json(array('status' => 'failed','message' => 'Food cannot be updated, please try again','title' => 'Update failed'),200);
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
        $this->selected_product = $this->product->where('id',$id)->first();
        if($this->selected_product):
            //check the category have foods or not
            if($this->selected_product->orders()->count() > 0):
                return response()->json(array('status' => 'failed','message' => 'Food cannot be deleted because it have takeouts, delete the takeout first','title' => 'Deletion failed!'),200);
            else:
                //remove the old images
                $product_image = $this->selected_product->image_path;
                if($this->product->destroy($id)):
                    if($product_image != null):
                        //remove the old images
                        $this->removeImages($this->upload_image_dir,$product_image);
                    endif;
                    // send the response back to the client with the success message
                    return response()->json(array('status' => 'success', 'message' => 'Food has been deleted successfully','title' => 'Food deleted!'),200);
                else:
                    //send the failed  message to teh client that the Food cannot be deleted
                    return response()->json(array('status' => 'failed', 'message' => 'Food cannot be deleted, please try again','title' => 'Deletion failed!'),200);
                endif;
            endif;
        else:
            return response()->json(array('status' => 'failed','message' => 'Food does not exists, please try again'),404);
        endif;
    }


    /**
     * function to update / insert the product image
     * @param $request, $update(bolean true / false)
     * @return void
     **/
    protected function updateOrInsertProductImages($request,$update=false){
        //check the request have the image or not 
        if($request->hasFile("image_path")):
            if($update):
                //need to remove the old images record from the storage
                $old_image = ProductImage::where('product_id',$this->selected_product->id)->select('image_path')->first();
                ProductImage::where('product_id',$this->selected_product->id)->delete();
                //need to remove the image for the file location
                $this->removeImages($this->upload_image_dir,$old_image);
            endif;
            //upload the new image
            $image = $this->uploadImage($request->file('image_path'),$thumbnail=true,$this->upload_image_dir);
            //store the product images
            $product_image_data = [
                'product_id' => $this->selected_product->id,
                'image_path' => $image,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            //insert the new product details in the storage
            ProductImage::insert($product_image_data);
        endif;
    }


    /**
     * function to update / insert the product details
     * @param  $request, $update
     * @return void
     **/
    protected function updateOrInsertProductDetails($request,$update=false){
        // a product price need to be updated 
        $i = 0;
        if($request->has('product_type') && $request->get('product_type') == "simple"):
            $product_detail_data[$i] = [
                'product_id' => $this->selected_product->id,
                'price'      => $request->input('price'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
             if($request->has('__is_available_for_change') && $request->get('__is_available_for_change') == "1"):
                    $product_detail_data[$i]['change_price'] = $request->input('__change_price');
            elseif($request->has('__is_available_for_change') && $request->get('__is_available_for_change') == "0"):
                    $product_detail_data[$i]['change_price'] = '0.00';
            endif;
        elseif($request->has('product_type') && $request->get('product_type') == "variable"):
            if($request->has('variable_price')):
                $variable_price          = $request->get('variable_price');
                $bbq_pcs                 = $request->get('bbq_pcs');
                $variable_product_number = $request->get('variable_product_number');
                for($i = 0; $i < count($variable_price); $i++):
                    $product_detail_data[] = [
                        'product_id'              => $this->selected_product->id,
                        'price'                   => $variable_price[$i],
                        'variable_product_number' => $variable_product_number[$i],
                        'bbq_pcs'                 => $bbq_pcs[$i],
                        'created_at'              => Carbon::now(),
                        'updated_at'              => Carbon::now()
                    ];
                endfor;
            endif;
        endif;
        //remove the product details if present for the product update
        if($update)
            ProductDetail::where('product_id',$this->selected_product->id)->delete();
        //insert the new product details
        ProductDetail::insert($product_detail_data);

        // update the change price is inserted
        // if($request->has('product_type') && $request->get('product_type') == "simple"):
        //     if($request->has('__is_available_for_change') && $request->get('__is_available_for_change') == "1"):
        //             $product_detail_data[$i][] = [
        //                 'product_id'        => $this->selected_product->id,
        //                 'change_price'      => $request->input('__change_price'),
        //                  'price'            => $request->input('price'),
        //                 'created_at'        => Carbon::now(),
        //                 'updated_at'        => Carbon::now()
        //             ];
        //     elseif($request->has('__is_available_for_change') && $request->get('__is_available_for_change') == "0"):
        //             $product_update_data = [
        //                 'product_id'        => $this->selected_product->id,
        //                 'change_price'      => '0.00',
        //                 'price'             => $request->input('price'),
        //                 'updated_at'        => Carbon::now(),
        //                 'updated_at'        => Carbon::now()
        //             ];
        //     endif;
        //     ProductDetail::insert($product_detail_data);
        // endif;
    }

}
