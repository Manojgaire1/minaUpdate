<?php

namespace App\Http\Controllers\Admin\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends Controller
{

    protected $selected_branch;
    protected $branch;
    /**
    *
    * constructor for product
    * @param product(object)
    *
    **/
    public function __construct(Branch $branch){
        $this->branch = $branch;
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
            $mina_branches = Branch::select('*')->orderBy('id','desc');
            return Datatables($mina_branches)
            ->addColumn('action', function ($branch) {
                $return_html = '<div class="dropdown">' .
                    '<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ti-more-alt"></i></button>' .
                    '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" >' .
                    '<ul>' .
                    '<li><button class="dropdown-item edit-btn" data-branch-id = "'.$branch->id.'" href = "#" > Edit</button ></li >'.
                    '<li ><a class="dropdown-item delete-btn" href = "#" data-branch-id = '.$branch->id.' > Delete</a ></li >'.
                    '</ul >'.
                    '</div ></div >';

                return $return_html;

            })->rawColumns(['action','en_description','jp_description'])
            ->make();
        else:
                return view('admin.branch.index');
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
        $this->selected_branch  = $this->branch->addBranch($data);
        if($this->selected_branch):
            return response()->json(array('status' => 'success','message' => 'Branch has been created successfully','title' => 'Successfully created'),200);
        else:
            return response()->json(array('status' => 'failed','message' => 'Branch cannot be created, please try again','title' => 'Failed'),200);
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
        $this->selected_branch = $this->branch::where('id',$id)->get();
        if($this->selected_branch):
            return response()->json(array('status' => 'success', 'branch' => $this->selected_branch,'message' => 'Branch has been fetched successfully!'),200);
        else:
            return response()->json(array('status' => 'failed','message' => 'Branch does not exist in the server'),404);
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
        $data = $request->except("_token");
        //save the product in database
        $this->selected_branch  = $this->branch->udpateBranch($data,$id);
        if($this->selected_branch):
            return response()->json(array('status' => 'success','message' => 'Branch has been updated successfully','title' => 'Successfully updated'),200);
        else:
            return response()->json(array('status' => 'failed','message' => 'Branch cannot be updated, please try again','title' => 'Failed'),200);
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
        $this->selected_branch = $this->branch->where('id',$id)->first();
        if($this->selected_branch):
            if($this->branch->destroy($id)):
                // send the response back to the client with the success message
                return response()->json(array('status' => 'success', 'message' => 'Branch has been deleted successfully','title' => 'Branch deleted!'),200);
            else:
                //send the failed  message to teh client that the Food cannot be deleted
                return response()->json(array('status' => 'failed', 'message' => 'Branch cannot be deleted, please try again','title' => 'Deletion failed!'),200);
            endif;
        else:
            return response()->json(array('status' => 'failed','message' => 'Branch does not exists, please try again'),404);
        endif;
    }
}
