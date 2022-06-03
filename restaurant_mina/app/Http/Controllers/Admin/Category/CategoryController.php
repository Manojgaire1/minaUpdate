<?php



namespace App\Http\Controllers\Admin\Category;



use App\Http\Controllers\Controller;

use App\Http\Controllers\Admin\AdminBaseController;

use Illuminate\Http\Request;

use App\Models\Category;

use Image;



class CategoryController extends AdminBaseController

{



    protected $category;

    protected $data = array();

    protected $upload_image_dir = "uploads/menus";

    protected $selectedCategory;



    public function __construct(Category $category){

        $this->category = $category;

    }

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {

        if($request->ajax()):

            $mina_menus = Category::select('*')->orderBy('order','asc');

            return Datatables($mina_menus)

            ->addColumn('image_path',function($mina_menu){

                if($mina_menu->image_path != null)

                    return asset('/uploads/menus/small'.'/'.$mina_menu->image_path);

                return asset('/admin-assets/images/foods/default_food_image.jpg');

            })

            ->addColumn('total_foods',function($mina_menu){

                return $mina_menu->products()->count();

            })

            ->addColumn('parent',function($mina_menu){

                if($mina_menu->parent):

                    $parent = Category::findOrFail($mina_menu->parent);

                    return $parent->en_name;

                else:

                    return 'None';

                endif;

            })

            ->addColumn('action', function ($mina_menu) {

                $return_html = '<div class="dropdown">' .

                    '<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                                <i class="ti-more-alt"></i></button>' .

                    '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" >' .

                    '<ul>' .

                    '<li><button class="dropdown-item edit-btn" data-menu-id = "'.$mina_menu->id.'" href = "#" > Edit</button ></li >'.

                    '<li ><a class="dropdown-item delete-btn" href = "#" data-menu-id = '.$mina_menu->id.' > Delete</a ></li >'.

                    '</ul >'.

                    '</div ></div >';



                return $return_html;



            })->rawColumns(['action','en_description','jp_description'])

            ->make();

        else:

                return view('admin.category.index')->with([

                    'menus'  => $this->category->all(),

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

        //check the request have the image or not 

        if($request->hasFile("category_image_path")):

            $image = $this->uploadImage($request->file('category_image_path'),$thumbnail=true,$this->upload_image_dir);

            $data['image_path'] = $image;

        endif;

        //save the category in database

        $this->selectedCategory  = $this->category->addCategory($data);

        if($this->selectedCategory):

            return response()->json(array('status' => 'success','message' => 'Menu has been created successfully','title' => 'Successfully created'),200);

        else:

            return response()->json(array('status' => 'failed','message' => 'Menu cannot be created, please try again','title' => 'Failed'),200);

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

        $this->selectedCategory = $this->category::findOrFail($id);

        if($this->selectedCategory):

            return response()->json(array('status' => 'success', 'menu' => $this->selectedCategory,'message' => 'Menu has been fetched successfully!'),200);

        else:

            return response()->json(array('status' => 'failed','message' => 'Menu does not exist in the server'),404);

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
        //get teh category by id

        $this->selectedCategory  = $this->category->where('id',$id)->first();

        $data = $request->except('_token');

        //check the image has been uploaded or not

        if($request->hasFile("category_image_path")):

            //upload the image and their various thumbnails

            $image = $this->uploadImage($request->file('category_image_path'),$thumbnail=true,$this->upload_image_dir);

            //need to remove the old image from the directory

            $this->removeImages($this->upload_image_dir,$this->selectedCategory->image_path);

            $data['image_path'] = $image;

        endif;

        //update the record in the storage

        $this->selectedCategory  = $this->category->updateCategory($data,$id);

        //send the response back to the client as per the db response

        if($this->selectedCategory):

            return response()->json(array('status' => 'success','message' => 'Menu has been updated successfully','title' => 'Successfully updated'),200);

        else:

            return response()->json(array('status' => 'failed','message' => 'Menu cannot be updated, please try again','title' => 'Update failed'),200);

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

        $this->selectedCategory = $this->category->where('id',$id)->first();

        if($this->selectedCategory):

            //check the category have foods or not

            if($this->selectedCategory->products()->count() > 0):

                return response()->json(array('status' => 'failed','message' => 'Menu cannot be deleted because it have foods on it, delete the food first','title' => 'Deletion failed!'),200);

            else:

                //remove the old images

                $category_image = $this->selectedCategory->image_path;

                if($this->selectedCategory->destroy($id)):

                    if($category_image != null):

                        //remove the old images

                        $this->removeImages($this->upload_image_dir,$category_image);

                    endif;

                    // send the response back to the client with the success message

                    return response()->json(array('status' => 'success', 'message' => 'Menu has been deleted successfully','title' => 'Menu deleted!'),200);

                else:

                    //send the failed  message to teh client that the menu cannot be deleted

                    return response()->json(array('status' => 'failed', 'message' => 'Menu cannot be deleted, please try again','title' => 'Deletion failed!'),200);

                endif;

            endif;

        else:

            return response()->json(array('status' => 'failed','message' => 'Menu does not exists, please try again'),404);

        endif;

    }

}

