<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('home.index');
    }


    
    public function runCode(Request $request){

        $data = $request->html_data;
        
        return view('home.play' , compact('data'));
    }
}
