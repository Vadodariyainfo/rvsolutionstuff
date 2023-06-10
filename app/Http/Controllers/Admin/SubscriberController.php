<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use Yajra\Datatables\Datatables;

class SubscriberController extends MainController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Subscriber::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action',function($row){
                        $btn = '';
                            $btn = $btn.' <button class="btn btn-danger btn-sm btn-flat remove-crud" data-id="'. $row->id .'" data-action="'. route('admin.subscriber.destroy',$row->id) .'"  data-toggle="tooltip" data-placement="top" data-original-title="Delete" title="Delete"> <i class="fa fa-trash"></i></button>';
                        return $btn;    
                    })
                    ->rawColumns(['action'])
                    ->make(true);

        }
        return view('admin.subscriber.index');
    }

    /**
     * Show the form for deleting a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Subscriber $subscriber)
    {
        $subscriber->delete();

        notificationMsg('success',$this->crudMessage('delete','Subscriber'));
        
        return redirect()->route('admin.subscriber.index');
    }
}
