@extends('layouts.master')

@section('title')
Blog-new-Post
@endsection
@section('posts_link')
id='hdr_link_select'
@endsection

@section('content')
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Add new post</div>
                <div class="panel-body">
                   
                   @if($allow_share==1)
                
                    <form class="form-horizontal" role="form" method="POST" action="/posts/store" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">You Post Title </label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="title" >
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
                                <select class="form-control" name="category_id" style="font-weight: bold;" onchange="new_category22()" id="category_id">
                                    <option value="new_category">
                                        <b>New Category</b>
                                    </option>
                                      @foreach($categories as $category)
                                       <option value="{{$category->id}}" selected="" >{{$category->name}}</option>
                                       @endforeach
                                </select>
                                <input type="text" name="new_category" placeholder="New Category" 
                                value="" id="new_category" class="form-control" style="display:none ;">
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
                                <textarea class="form-control" name="body" id="body" style="background-image: url('/upload/paper.jpg');"></textarea> 

                                @if ($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                            <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                            <label for="url" class="col-md-4 control-label"> Select Image
                            <i class=" fas fa-image"> </i></label>

                            <div class="col-md-6" style="background-color: #e9ebee; border-radius: 10px; width: 360px; margin-left: 10px;">
                                <input type="file" name="url" id="url" class="btn fa-btn" />
                                @if ($errors->has('url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-btn fa-sign-in-alt"></i> Add Post
                                </button>
                            </div>
                        </div>
                    </form>

                    @else
                      <h2 class="text-danger text-center">Sorry , you can't share posts now !!</h2>
                    @endif
                </div>
            </div>
        </div>
    
@endsection
