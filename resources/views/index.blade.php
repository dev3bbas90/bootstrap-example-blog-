@extends('layouts.master')

@section('title')
Welcome-blog
@endsection

@section('hide_sidebar')
id='hide_sidebar'
@endsection

@section('content')
<div class="text-danger text-center">
   @foreach($errors->all() as $error)
      <strong>{{$error}} <a href="/login">Login</a> </strong>
   @endforeach
 </div>
<br /><br />
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Home Page</div>
                <div class="panel-body" style="text-align: center;">
                    Your are Welcome .
                    <h2> Allowed for all users </h2>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_id1')
<div id="gab_footer">
@endsection

@section('footer_id2')
</div>
@endsection

