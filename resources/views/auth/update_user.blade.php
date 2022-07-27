@extends('layouts.master')

@section('title')
Update user Data
@endsection

@section('hide_sidebar')
id='hide_sidebar'
@endsection

@section('register_link')
id='hdr_link_select'
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update user Data</div>
                <div class="panel-body">
                   
                    <form class="form-horizontal" role="form" method="POST" action="/save_update_user/{{ $user->id}}" enctype="multipart/form-data">
                        <!-- action="{{ url('/register') }}" -->
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <table style="width: 90%;">
                                <tr>
                                <td style="width: 25%; text-align: right;">
                                  <label for="name" class="col-md-10 control-label">Name</label>
                                  </td>
                                  <td style="width: 45%;">
                                    <input id="name" style="" type="text" class="form-control" name="name" value="{{ $user->name }}" />
                                     @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                  </td>
                                  <td class="text-right" style="padding-left: 10px; text-align: right;">
                                    <!-- <button class="form-control btn-primary"  style="">Change</button> -->
                                  </td>
                              </tr>
                            </table>
                        </div>
                        
                    <!-- ////////////////////////////////////////////////////////// -->
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <table style="width: 90%;">
                                <tr>
                                <td style="width: 25%; text-align: right;">
                            <label for="username" class="col-md-10 control-label">Username</label>
                            </td>
                           <td style="width: 45%;">
                             <input id="username2" type="text" class="form-control" name="username" value="{{ $user->username }}" />
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </td>
                             <td class="text-right" style="padding-left: 10px; text-align: right;">
                                   <!--  <button class="form-control btn-primary"  style="">Change</button> -->
                                  </td>
                              </tr>
                            </table>
                        </div>
                        <!-- ///////////////////////////////////////////// -->
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <table style="width: 90%;">
                             <tr>
                             <td style="width: 25%; text-align: right;">
                            <label for="email" class="col-md-10 control-label">E-Mail Address</label>
                           </td>
                           <td style="width: 45%;">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </td>
                             <td class="text-right" style="padding-left: 10px; text-align: right;">
                                   <!--  <button class="form-control btn-primary"  style="">Change</button> -->
                                  </td>
                              </tr>
                            </table>
                        </div>
                        <!-- ///////////////////////////////////////////// -->
                        <div class="form-group{{$errors->has('role') ? ' has-error' : '' }}">
                          <table style="width: 90%;">
                             <tr>
                             <td style="width: 25%; text-align: right;">
                            <label for="role" class="col-md-10 control-label">User Role</label>
                            </td>
                            <td style="width: 45%;">
                                <select class="form-control" name="role" onchange="">
                                      <option value="1"{{($user->role==1)?'selected' : null}}>Admin</option>
                                      <option value="2"{{($user->role==2)?'selected' : null}}>Manager</option>
                                      <option value="3"{{($user->role==3)?'selected' : null}}>User</option>
                                  </select>
                                @if ($errors->has('role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                            </td>
                             <td class="text-right" style="padding-left: 10px; text-align: right;">
                                    <!-- <button class="form-control btn-primary"  style="">Change</button> -->
                                  </td>
                              </tr>
                            </table>
                        </div>
                        <!-- /////////////////////////////////////////////////// -->
                        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                           <table style="width: 90%;">
                             <tr>
                             <td style="width: 25%; text-align: right;">
                            <label for="url" class="col-md-10 control-label"> Your Profile
                            <i class=" fas fa-image"> </i></label>
                        </td>
                        <td style="width: 45%; text-align: center;">
                              <img src="/upload/users/{{$user->profile}}" style="width: 100px; height:140px;">  
                            </td>
                            <input type="text" id="url_txt" name="url_txt" value="{{$user->profile}}" style="display: none;">
                             <td class="text-right" style="padding-left: 10px; text-align: right;">
                                <input type="file" name="url" id="url" value="{{$user->profile}}" class="btn fa-btn" onchange="profile()" />
                                @if ($errors->has('url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif

                                  </td>
                                  <td>
                                    <!--  <a href="" class="form-control btn-primary"  style="">Save</a> -->
                                  </td>
                              </tr>
                            </table>
                        </div>
                      
                        <!-- ////////////////////////////////////////////////// -->
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <table style="width: 90%;">
                             <tr>
                             <td style="width: 25%; text-align: right;">
                            <label for="password-confirm" class="col-md-10 control-label">Password</label>
                                </td>
                            <td style="width: 45%;">
                                <input id="password2" type="password" class="form-control" name="password" value="nullll">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                           </td>
                             </td>
                             <td class="text-right" style="padding-left: 10px; text-align: right;">
                                  </td>
                              </tr>
                            </table>
                        </div>
                        <!-- //////////////////////////////////////// -->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                             <input type="submit" class="btn btn-primary"  value="Save changes" />
                             <button type="reset" class="btn btn-danger">
                                      Cancel Changes
                                </button>
                            </div>
                        </div>
                    </form>
                    
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