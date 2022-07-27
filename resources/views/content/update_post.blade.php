@extends('layouts.master')

@section('title')
Blog-new-Post
@endsection
@section('posts_link')
id='hdr_link_select'
@endsection

@section('hide_logoimg')
display:none;
@endsection

@section('logoimg')
  <img src="/upload/car1.jpg" id="logo_img">
@endsection

@section('content')
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Add new post</div>
                <div class="panel-body">
                   
               <form class="form-horizontal" role="form" method="POST" action="/save post edititon/{{$post->id}}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">You Post Title </label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="title"  value="{{$post->title}}">
                                <!-- onfocus="this.value='',document.getElementById('body').value=''" -->
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label for="category_id" class="col-md-4 control-label">You Post category </label>
                            <div class="col-md-6">
                                <select class="form-control" name="category_id" style="font-weight: bold;">
                                      @foreach($categories as $category)
                                       
                                       <option value="{{$category->id}}"
                                        @if($category->id==$post->category_id)
                                        selected
                                        @endif 
                                        > {{$category->name}}</option>
                                       @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                            <label for="body" class="col-md-4 control-label">Post content</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="body" id="body" style="background-image: url('/upload/paper.jpg');">{{$post->body}}</textarea> 

                                @if ($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="url" class="col-md-4 control-label"> Post Image
                            <i class=" fas fa-image"> </i></label>
                            <div class="col-md-6 text-center" >
                                <input type="text" name="stay_post_photo" id="stay_post_photo"         value="1" style="display:none ;" />
                                <div class="row">
                                    <div class="col-md-8 text-center">
                                        @if($post->url)
                                        <img src="/upload/{{$post->url}}" id="profile_img" />
                                        @else
                                        <b>No Images Found</b>
                                        @endif

                                    </div>
                                    <div class="col-md-4 text-right">
                                        <br />
                                       <b class="btn-danger btn-text" id="del_post_img_btn" onclick="del_post_img()">&nbsp; Delete &nbsp;</b>
                                    </div>

                                    <b class="btn-primary btn-text" id="ret_post_img_btn" onclick="ret_post_img()" style="display: none;">&nbsp;  post image &nbsp;</b>
                                    </div>
                            </div>
                                 

                                @if ($errors->has('url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                            <label for="url" class="col-md-4 control-label"> Change Image
                            <i class=" fas fa-image"> </i></label>

                            <div class="col-md-6" style="background-color: #e9ebee; border-radius: 10px; width: 360px; margin-left: 10px;">

                                <input type="file" name="url" value="" onchange="selectpostimg()" id="url" class="btn fa-btn" />

                                @if ($errors->has('url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button class="btn btn-danger"  onclick="window.open('/posts/readmore/{{$post->id}}','_self')">
                                    <i class="fas fa-btn fa-arrow-left"></i>Go Back
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-btn fa-sign-in-alt"></i> Save Post
                                </button>
                            </div>
                        </div>
                    </form>

                   
                </div>
            </div>
        </div>
    
@endsection
