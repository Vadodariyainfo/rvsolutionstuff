<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Tutorial;
use App\Models\Language;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class TutorialController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Tutorial::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('language',function($row){
                        return $row->language->name;
                    })
                    ->addColumn('action',function($row){
                        $btn = '';
                            if(!empty($row->slug)){
                                $btn = ' <a href="'. route('tutorialDetails',[$row->language->slug,$row->slug]) .'" class="btn btn-info btn-sm btn-flat" data-toggle="tooltip" data-placement="top" data-original-title="View" title="View"><i class="fa fa-eye"></i></a>';
                            }else{
                                $btn = ' <a href="'. route('tutorial') .'" class="btn btn-info btn-sm btn-flat" data-toggle="tooltip" data-placement="top" data-original-title="View" title="View"><i class="fa fa-eye"></i></a>';
                            }
                            $btn = $btn.' <a href="'. route('tutorials.edit',[$row->id]) .'" class="btn btn-primary btn-sm btn-flat" data-toggle="tooltip" data-placement="top" data-original-title="Edit" title="Edit"><i class="fa fa-edit"></i></a>';
                            $btn = $btn.' <button class="btn btn-danger btn-sm btn-flat remove-crud" data-id="'. $row->id .'" data-action="'. route('tutorials.destroy',$row->id) .'"  data-toggle="tooltip" data-placement="top" data-original-title="Delete" title="Delete"> <i class="fa fa-trash"></i></button>';
                        return $btn;    
                    })
                    ->rawColumns(['action','language'])
                    ->make(true);
        }

        return view('admin.tutorial.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = Language::pluck('name','id')->toArray();

        return view('admin.tutorial.create',compact('language'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        
        $request->validate([
            'language_id'=>'required',
            'topic_name'=>'required',
            'description'=>'required',
            'sort'=>'required',
            'meta_title'=>'required',
            'meta_description'=>'required',
        ],
        [
            'language_id.required' => 'The language field is required.'
        ]);

        $input['slug'] = Str::slug($input['topic_name']);

        Tutorial::create($input);

        notificationMsg('success',$this->crudMessage('add','tutorial'));

        return redirect()->route('tutorials.index');
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
    public function edit(Tutorial $tutorial)
    {
        $language = Language::pluck('name','id')->toArray();

        return view('admin.tutorial.edit',compact('language','tutorial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tutorial $tutorial)
    {
        $input = $request->all();

        $request->validate([
            'language_id'=>'required',
            'topic_name'=>'required',
            'description'=>'required',
            'sort'=>'required',
            'meta_title'=>'required',
            'meta_description'=>'required',
        ],
        [
            'language_id.required' => 'The language field is required.'
        ]);

        $input['slug'] = Str::slug($input['topic_name']);

        $tutorial->update($input);

        notificationMsg('success',$this->crudMessage('update','tutorial'));

        return redirect()->route('tutorials.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tutorial $tutorial)
    {
        $tutorial->delete();
        
        notificationMsg('success',$this->crudMessage('delete','tutorial'));

        return redirect()->route('tutorials.index');
    }
}
