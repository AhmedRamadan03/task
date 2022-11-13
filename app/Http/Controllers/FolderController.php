<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Zip;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('is_admin' , '0')->pluck('username', 'id')->toArray();
        $resource = request()->resource_id > 0 ? Folder::find(request()->resource_id) : new Folder();
        if (auth()->user()->is_admin == '1') {
            $query = Folder::latest();
        } 
        else {
            $query = Folder::where('user_id',auth()->user()->id )->latest();
        }

        if (request()->search) {
                $query->where('files->name' , 'like' ,'%' . request()->search .'%');                
        }

        if (request()->user_id) {
                $query->where('user_id' , request()->user_id);
        }
        $folders = $query->paginate(20);
        return view('folders.index' , compact('folders' ,'resource' , 'users'));
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
        
        $validator = validator($request->all(), [
            'file' => 'required|file|mimes:zip',   // required 
        ]); // create the validations

        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {
            session()->flash('error', $validator->errors());
            return redirect()->route('folders.index');
            // validation failed return back to form

        } else {
            $folder = $request->file;
            $status     = Zip::open($request->file("file")->getRealPath());
            $listFiles  = Zip::listFiles($folder);

                Zip::extract('temb/' , $folder);
                Zip::close();

                $files = Storage::disk('public_uploads')->listContents();
                $listFiles = [];
                foreach ($files as $key => $value) {
                    //dd($value);
                    $file_data = [
                        'name' => $value['path'],
                        'size' => $value['size'] / 1024,
                        'type' => $value['type'] . '-' .$value['extension'] ,
                    ];
                    $user = User::findorFail($request->user_id);
                    Folder::create([
                        'username' => $user->username,
                        'user_id' => $user->id,
                        'files' => json_encode($file_data)
                    ]);
                    // $listFiles[] = $file_data;
                    File::move(public_path('temb') . "/" . $value['path'], public_path("uplouds") . "/" . $value['path']);
                }
               
            
                return back()
                ->with('success','You have successfully extracted zip.');
            
            
        
        }
       
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function show(Folder $folder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function edit(Folder $folder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Folder $folder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = Folder::findOrFail($id);
        $file_name =  json_decode($file->files)->name;
        Storage::disk('uploads_files')->delete( "/" .$file_name);
        $file->delete();
        session()->flash('success', 'Item Deleted successfully');
        return redirect()->route('folders.index');
    }

    
    public function openFile($file_name)
    {
        $files = Storage::disk('uploads_files')->getDriver()->getAdapter()->applyPathPrefix( "/".$file_name);
        return response()->file($files);
    }

    public function download($file_name)
    {
        $files = Storage::disk('uploads_files')->getDriver()->getAdapter()->applyPathPrefix( "/".$file_name);
        return  response()->download($files);
    }
}
