@extends('layouts.master')

@section('title')
    folders
@endsection

@section('css')
    <style>
        .folders{
            background: #fafafa;
            height: 605px;
            overflow-y: scroll;
        }
        .table-style{
            box-shadow: 0 0 10px -7px;
    background: white;
        }
    </style>
@endsection


@section('contant')
@include('partials._session')
<br><br>
    <section class="folders pt-5 pb-5">

        <div class="container table-style p-4 pb-5">
            <div class="card" >
                <div class="card-header">
                   <button type="button" class="btn" id="filter"> Filter</button>
                </div>
                <div class="card-body filter">
                    <div class="form-filter">
                        <form action="{{ route('folders.index') }}" method="GET">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::text('search', request()->search, ["class" => 'form-control']) !!}
                                    </div>
                                </div>
                               @if (auth()->user()->is_admin == '1')
                               <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::select('user_id', $users, request()->user_id, ["class"=> 'form-control form-select' , "placeholder"=>'select user']) !!}
                                </div>
                            </div>
                               @endif
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" value="filter">
                                <a href="{{ route('folders.index') }}" class="btn btn-secondary">clear</a>
                             </div>
                            
                        </form>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <div>
                <button type="button" class="btn btn-primary w3-text-white" onclick="$('.form-modal').modal('show')">
                    <i class="feather-16" data-feather="plus"></i> Add folder +
            
                </button>
                <br>
            </div>
            

            @include('folders.form')

            <table class="table pt-5">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">File name</th>
                    <th scope="col">type</th>
                    <th scope="col">size</th>
                    
                    <th scope="col">action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($folders as $folder)
                   {{-- @foreach (json_decode($folder->files) as $file) --}}
                   <tr>
                     <th scope="row">{{ $loop->iteration }}</th>
                     <td><a href="{{ route('folders.openFile' , json_decode($folder->files)->name) }}">{{ json_decode($folder->files)->name }}</a></td>
                     <td>{{ json_decode($folder->files)->type }}</td>
                     <td>{{ round(json_decode($folder->files)->size ,1)}} KB</td>
                     <td>
                         <form action="{{ route('folders.destroy',$folder->id) }}" method="post" style="display: inline;">
                             @csrf
                             <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash "></i>Delete</button>
                         </form>
                     </td>
                   </tr>
                   {{-- @endforeach --}}
                      
                    @endforeach
                  
                </tbody>
              </table>
        </div>
        {{ $folders->links() }}
    </section>
@endsection


@section('js')

@endsection