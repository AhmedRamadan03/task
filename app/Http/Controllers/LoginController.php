<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
class LoginController extends Controller
{

    function viewLogin(){
        return view('auth.login');
    }


    function doLogin(Request $request)
    {

        $validator = validator($request->all(), [
            'username' => 'required',   // required 
            'password' => 'required', // required and number field validation

        ]); // create the validations
        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {
            return response()->json($validator->errors(),422);  
            // validation failed return with 422 status

        } else {
            //validations are passed try login using laravel auth attemp
            if (\Auth::attempt($request->only(["username", "password"]))) {
                return response()->json(["status"=>true,"redirect_location"=>url("/home")]);
                
            } else {
                return response()->json([["Invalid credentials"]],422);
                
            }
        }
    }

    function doRegister(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username',   // required 
            'password' => 'required|min:8', // required and number field validation
            'confirm_password' => 'required|same:password',

        ]); // create the validations
        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {
            return response()->json($validator->errors(),422);  
            // validation failed return back to form

        } else {
            //validations are passed, save new user in database
            $User = new User;
            $User->username = $request->username;
            $User->password = bcrypt($request->password);
            $User->save();
            
            return response()->json(["status"=>true,"msg"=>"You have successfully registered, Login to access your dashboard","redirect_location"=>url("/")]);  
           
        }
    }
   // show dashboard
    function dashboard()
    {
        return view("dashboard");
    }

    // logout method to clear the sesson of logged in user
    function logout()
    {
        \Auth::logout();
        return redirect("/login")->with('success', 'Logout successfully');;
    }
}
