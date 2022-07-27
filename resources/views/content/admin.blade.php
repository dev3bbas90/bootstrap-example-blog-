@extends('layouts.master')

@section('title')
Admin 
@endsection

@section('control_link')
id='hdr_link_select'
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
                <div class="panel-heading">Welcome</div>

                <div class="panel-body" style="text-align: center; font-size: 17px; font-weight: bold;">
                    Only for Admin
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

