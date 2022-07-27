@extends('layouts.master')

@section('title')
my-profile
@endsection


@section('hide_sidebar')
id='hide_sidebar'
@endsection

@section('content')
<br /><br />
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">&nbsp; &nbsp; MY Profile</div>

                    <table class="table" id="control_table">
                           
                           <tr>
                            <td>Name  </td>
                            <td>{{ Auth::user()->name }}</td>
                          </tr>
                           <tr>
                            <td>Profile </td>
                            <td>
                              <img src="/upload/users/{{ Auth::user()->profile}}" id="profile_img" />
                            </td>
                          </tr>
                          <tr>
                            <td>UserName </td>
                            <td>{{ Auth::user()->username }}</td>
                          </tr>
                          <tr>
                            <td>Email </td>
                            <td>{{ Auth::user()->email }}</td>
                          </tr>
                          <tr>
                            <td>Password </td>
                            <td>......</td>
                          </tr>
                          <tr>
                            <td>Role </td>
                            <td>{{(Auth::user()->role==1)?'Admin' : (Auth::user()->role==2)?'Manager':'User'}}</td>
                          </tr>
                          <tr>
                            <td colspan="2">
                              <a href="/update my profile" class="btn btn-primary">Update Your Profile</a>
                            </td>
                          </tr>
                          
                       </table>

            </div>
        </div>
    </div>
</div>
@endsection


