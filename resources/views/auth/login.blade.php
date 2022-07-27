@extends('layouts.master')

@section('title')
Blog-login
@endsection

@section('login_link')
id='hdr_link_select'
@endsection


@section('hide_sidebar')
id='hide_sidebar'
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    
                    <form class="form-horizontal" role="form" method="POST" action="/userlogin">
                        <!-- {{ url('/login') }} -->
                        {{ csrf_field() }}
                        <input type="text" value="{{$allow_login}}" name="allowed" style="display: none;">
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="" onfocus="this.value='',document.getElementById('password').value=''">

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-btn fa-sign-in-alt"></i>&nbsp; Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                            </div>
                        </div>
                        @foreach($errors->all() as $error)
                        <div class="text-center"><b style="color: brown;">{{$error}}</b></div>
                        <br />  
                        @endforeach
                    </form>
                    @if($allow_login==1)    
                    @else
                     <div class="text-center" id="comment_table" style="color:brown;">
                           <b>sorry , Login is currently Closed by Admin !!</b>
                     </div>
                   @endif


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