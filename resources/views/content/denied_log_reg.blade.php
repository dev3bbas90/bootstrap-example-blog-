@extends('layouts.master')

@section('title')
Blog-register
@endsection

@section('hide_sidebar')
id='hide_sidebar'
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                     <div id="comment_table">
                        @if($log_reg==1)
                           <b>sorry , login is currently Closed !!</b>
                           @else
                           <b>sorry , Registeration is currently Closed !!</b>
                        @endif
                     </div>
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