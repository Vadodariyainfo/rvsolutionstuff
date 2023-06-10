<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Contact;

class ContactController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Contact::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action',function($row){
                        $btn = '';
                            $btn = '<a href="'.route('contactus.show',[$row->id]).'" class="btn btn-info btn-sm btn-flat" data-toggle="tooltip" data-placement="top" data-original-title="Show" title="Show"><i class="fa fa-eye"></i></a>';
                            $btn = $btn.' <a href="'.route('contactus.replay',[$row->id]).'" class="btn btn-primary btn-sm btn-flat" data-toggle="tooltip" data-placement="top" data-original-title="Show" title="Show"><i class="fa fa-envelope"></i></a>';
                            $btn = $btn.' <button class="btn btn-danger btn-sm btn-flat remove-crud" data-id="'. $row->id .'" data-action="'. route('contactus.destroy',$row->id) .'"  data-toggle="tooltip" data-placement="top" data-original-title="Delete" title="Delete"> <i class="fa fa-trash"></i></button>';
                        return $btn;    
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.contact.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contactu)
    {
        return view('admin.contact.show',compact('contactu'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contactu)
    {
        $contactu->delete();
        
        notificationMsg('success',$this->crudMessage('delete','Contact'));
        return redirect()->route('contactus.index');
    }

    public function contactusReplay($id)
    {
        $user = Contact::find($id);
        return view('admin.contact.mail',compact('user'));
    }

    public function contactusReplaySend(Request $request)
    {
        $details = [
            'email' => $request->email,
            'title' => $request->title,
            'body' => $request->body,
        ];
        
        $contactReplay = $request->email;
        $mail = $contactReplay;
        \Mail::to($mail)->send(new \App\Mail\MyTestMail($details));
        
        return redirect()->route('contactus.index');
    }

    public function contactusTrunct()
    {
        $all = Contact::all();
        $contact = Contact::truncate();
        notificationMsg('success',$this->crudMessage('delete','Contact'));
        return redirect()->route('contactus.index');
    }
}
