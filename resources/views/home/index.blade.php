@extends('layouts.master')

@section('title')
    Home
@endsection

@section('css')
    
@endsection


@section('contant')
<br><br><br><br>
    <section class="home">
        <div class="container">
            <form action="{{ route('run') }}" method="get">
               @csrf
                <div class="box-area">
                <label for="$html-data"><b>Write HTML & CSS :</b></label>
                <textarea name="html_data" class="form-control" id="html-data" cols="30" rows="10"></textarea>
                </div><br>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" id="" value="Run Code">
                </div>
            </form>
        </div>
    </section>
@endsection


@section('js')
    
@endsection