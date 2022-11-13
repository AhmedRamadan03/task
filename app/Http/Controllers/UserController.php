<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Arr;
class UserController extends Controller
{
    public function index(){
        $resource = request()->resource_id > 0 ? User::find(request()->resource_id) : new User();
        $users = User::where('is_admin' , '0')->latest()->paginate(20);
        return view('users.index' , compact('users' ,'resource'));
    }

    public function show(User $user)
    {
        //
    }

    public function store(Request $request)
    { 
        
        $validator = validator($request->all(), [
            'username' => 'required|unique:users,username',   // required 
            'password' => 'required|min:8', // required and number field validation
            'confirm_password' => 'required|same:password',

        ]); // create the validations
        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {
            session()->flash('error', $validator->errors());
            return redirect()->route('users.index');
            // validation failed return back to form

        } else {
            //validations are passed, save new user in database
            $User = new User;
            $User->username = $request->username;
            $User->password = bcrypt($request->password);
            $User->save();
            
            session()->flash('success', 'info add successfully');
            return redirect()->route('users.index');
           
        }
    }

    public function update(Request $request , $id){
        $validator = validator($request->all(), [
            'username' => 'required|unique:users,username,'.$id,   // required 
            'password' => 'same:confirm_password',

        ]); // create the validations
        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {
            session()->flash('error', $validator->errors());
            return redirect()->route('users.index');
            // validation failed return back to form

        } else {
            //validations are passed, save new user in database
            $User = User::findOrFail($id);
            $data= $request->except('confirm_password');
            $data['username'] = $request->username;
            if(!empty($data['password'])){ 
                $data['password'] =  bcrypt($data['password']);
            }else{
               $data = Arr::except($data,array('password'));
            }
            $User->update($data);
           
            
            session()->flash('success', 'info Edit successfully');
            return redirect()->route('users.index');
           
        }
    }


    public function destroy($id){
        User::findOrFail($id)->delete();
        session()->flash('success', 'Item Deleted successfully');
        return redirect()->route('users.index');
    }

  
}

