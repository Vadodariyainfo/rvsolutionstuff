<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;
use Validator;

class ProfileController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->user = new User;
    }

    public function profile(User $user)
    {   
        $user = User::where('id',Auth::user()->id)->first();
        return view('admin.profile.index',compact('user'));
    } 

    public function updateProfile(request $request, User $user)
    {   
        $input = $request->all();

        $this->validate($request, [
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$input['id'],
            'new_password' => 'string|nullable',
            'confirm_password' => "same:new_password",
        ]);

        if($input['new_password'] != ''){
            $input['password'] = Hash::make($input['new_password']);
        }

        unset($input['_token']);   
        unset($input['new_password']);   
        unset($input['confirm_password']);

        $this->user->updateProfile($input);

        notificationMsg('success',$this->crudMessage('update','Profile'));
        if(Auth::user()->is_admin == 1)
        {
            return redirect()->route('admin.profile');
        }else{
            return redirect()->route('user.admin.profile');
        }
        
    }
}
