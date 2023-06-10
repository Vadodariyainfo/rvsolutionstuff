<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use Illuminate\Http\Request;
use App\Models\Language;
use Yajra\Datatables\Datatables;
use App\Models\ImageUpload;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class LanguageController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Language::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image',function($row){
                        if(!empty($row->image)){
                            return '<img src="'. route('image.asset.storage.file',['folder' => 'language', 'file' => $row->image]) .'" width="100px">';
                        }else{
                            return '-';
                        }
                    })
                    ->addColumn('action',function($row){
                        $btn = '';
                            $btn = ' <a href="'. route('languages.edit',[$row->id]) .'" class="btn btn-primary btn-sm btn-flat" data-toggle="tooltip" data-placement="top" data-original-title="Edit" title="Edit"><i class="fa fa-edit"></i></a>';
                            $btn = $btn.' <button class="btn btn-danger btn-sm btn-flat remove-crud" data-id="'. $row->id .'" data-action="'. route('languages.destroy',$row->id) .'"  data-toggle="tooltip" data-placement="top" data-original-title="Delete" title="Delete"> <i class="fa fa-trash"></i></button>';
                        return $btn;    
                    })
                    ->rawColumns(['action','image'])
                    ->make(true);
        }

        return view('admin.language.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.language.create');
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
            'image'=>'required',
            'name'=>'required',
            'description'=>'required',
            'meta_title'=>'required',
            'meta_description'=>'required',
        ]);

        if($request->hasFile('image')){
            $input['image'] = ImageUpload::upload('public/language/',$request->file('image'));
        }

        $input['slug'] = Str::slug( $input['name']);

        Language::create($input);

        notificationMsg('success',$this->crudMessage('add','Language'));

        return redirect()->route('languages.index');
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
    public function edit(Language $language)
    {
        return view('admin.language.edit',compact('language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Language $language)
    {
        $input = $request->all();

        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'meta_title'=>'required',
            'meta_description'=>'required',
        ]);

        if($request->hasFile('image')){
            if(!empty($language->image)){
                ImageUpload::removeFile('public/language/'.$language->image);
            }
            $input['image'] = ImageUpload::upload('public/language/',$request->file('image'));
        }
        
        $input['slug'] = Str::slug( $input['name']);
        
        $language->update($input);

        notificationMsg('success',$this->crudMessage('update','language'));

        return redirect()->route('languages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Language $language)
    {
        $language->delete();

        notificationMsg('success',$this->crudMessage('delete','language'));

        return redirect()->route('languages.index');
    }
}
