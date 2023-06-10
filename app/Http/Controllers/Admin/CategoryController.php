<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\BlogCategory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\ImageUpload;

class CategoryController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = BlogCategory::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('post',function($row){
                        return '<span class="badge badge-primary" style="font-size:13px;">'. $row->post->count().'</span>';
                    })
                    ->addColumn('action',function($row){
                        $btn = '';
                            $btn = ' <a href="'. route('categorys.edit',[$row->id]) .'" class="btn btn-primary btn-sm btn-flat" data-toggle="tooltip" data-placement="top" data-original-title="Edit" title="Edit"><i class="fa fa-edit"></i></a>';
                            $btn = $btn.' <button class="btn btn-danger btn-sm btn-flat remove-crud" data-id="'. $row->id .'" data-action="'. route('categorys.destroy',$row->id) .'"  data-toggle="tooltip" data-placement="top" data-original-title="Delete" title="Delete"> <i class="fa fa-trash"></i></button>';
                        return $btn;    
                    })
                    ->rawColumns(['action','post'])
                    ->make(true);
            \Log::info($data);
        }

        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'name'=>'required',
            'meta_description'=>'required',
            'image' => 'required',
        ]); 

        $input['slug'] = Str::slug($input['name']);

        if($request->hasFile('image')){
            $input['image'] = ImageUpload::upload('public/category/',$request->file('image'));
        }

        //Create Category
        BlogCategory::create($input);

        notificationMsg('success',$this->crudMessage('add','Category'));
        return redirect()->route('categorys.index');
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
        //Get Category Id
        $category = BlogCategory::find($id);

        return view('admin.category.edit',compact('category'));
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
        $category = BlogCategory::find($id);

        $input = $request->validate([
            'name'=>'required',
            'meta_description'=>'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]); 

        $input['slug'] = Str::slug($input['name']);

        if($request->hasFile('image')){
            if(!empty($category->image)){
                ImageUpload::removeFile('public/category/'.$category->image);
            }
            $input['image'] = ImageUpload::upload('public/category/',$request->file('image'));
        }

        //Update Category 
        BlogCategory::find($id)->update($input);

        notificationMsg('success',$this->crudMessage('update','Category'));
        return redirect()->route('categorys.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete Category
        BlogCategory::find($id)->delete();
        
        notificationMsg('success',$this->crudMessage('delete','Category'));
        return redirect()->route('categorys.index');
    }
}
