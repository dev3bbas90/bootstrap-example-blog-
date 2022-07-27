@extends('layouts.master')

@section('title')
Welcome-blog
@endsection

@section('hide_sidebar')
id='hide_sidebar'
@endsection

@section('content')
<br /><br /><br />
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Warning</div>

                <div class="panel-body" style="text-align: center;">
                   <h1 class="danger">Sorry , Access Denied !! </h1>
                    <h2> You don't have Permission to access this page :( </h2>
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

