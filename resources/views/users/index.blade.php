@extends('layouts.master')

@section('title')
    Users
@endsection

@section('css')
    <style>
        .users{
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
    <section class="users pt-5">
        <div class="container table-style p-4">
           @if (auth()->user()->is_admin == '1')
           <button type="button" class="btn btn-primary w3-text-white" onclick="$('.form-modal').modal('show')">
            <i class="feather-16" data-feather="plus"></i> Add User
    
            </button>
           @endif
            @include('users.form')
            <hr>

            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">username</th>
                    <th scope="col">action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $user->username }}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('users.index' ) }}?resource_id={{ $user->id }}">Edit</a>
                            <form action="{{ route('users.destroy',$user->id) }}" method="post" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash "></i>Delete</button>
                            </form>
                        </td>
                      </tr>
                      
                    @endforeach
                  
                </tbody>
              </table>
        </div>
        {{ $users->links() }}
    </section>
@endsection


@section('js')
        <script>
         @if (request()->resource_id > 0)
            $('.form-modal').modal('show');
        @endif
    </script>
@endsection