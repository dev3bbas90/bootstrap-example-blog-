@extends('layouts.master')

@section('title')
About
@endsection

@section('about_link')
id='hdr_link_select'
@endsection

@section('content')
         <div class="row" id="row-post">
            <div class="panel panel-default">
                <div class="panel-heading" id="">About Blog Site</div>

                <div class="panel-body" id="">
                  <!-- ////////////////////////////////////////////////////////// -->
                  <div>
                            <div class="row">
                                <div class="col col-md-6">
                                    <p>This is about page , it show what this site do and how to work , 
                                    This is about page , it show what this site do and how to work , 
                                    </p>
                                </div>
                                <div class="col col-md-6 text-center">
                                    <img src="/upload/car1.jpg" class="about_img" />
                                </div>

                            </div>
                        </div> 
                        <hr>
                   <p class="capitalize"> <span id="comments_title" >Any title : </span>
                     This is about page , it show what this site do and how to work , 
                        This is about page , it show what this site do and how to work , 
                        <hr>This is about page , it show what this site do and how to work , 
                        This is about page , it show what this site do and how to work , 
                        This is about page , it show what this site do and how to work ,
                        <hr>
                    </p>
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

