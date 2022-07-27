@extends('layouts.master')


@section('title')
Control-users
@endsection

@section('control_link')
id='hdr_link_select'
@endsection

@section('hide_sidebar')
id='hide_sidebar'
@endsection


@section('content')
<br />
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default" id="users">
                <div class="panel-heading">Control users privileges</div>
                <div class="panel-body"> 

                  <div class="bs-example" data-example-id="panel-without-body-with-table">
                    <div class="panel panel-default" >

                      <table class="table" id="control_table">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>E-mail</th>
                            <th>Role</th>
                            <th>control</th>
                          </tr>
                        </thead>
                        <tbody>
                         @foreach($users as $user) 
                          <tr>
                            <td scope="row">{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                            @if($user->id==1)
                            <b>Admin </b>
                            @elseif(Auth::user()->role>1)
                            <b>Disabled</b>
                            @else
                              <div class="form-group" style="margin-bottom: 0px;">
                                  <form method="post" action="/roleupdate/{{$user->id}}">
                                  {{csrf_field()}}
                                    <select class="form-control" name="role" onchange="this.form.submit()">
                                      <option value="1"{{($user->role==1)?'selected' : null}}>Admin</option>
                                      <option value="2"{{($user->role==2)?'selected' : null}}>Manager</option>
                                      <option value="3"{{($user->role==3)?'selected' : null}}>User</option>
                                    </select>
                                  </form>
                              </div>
                              @endif
                            </td>
                            <td style="">
                              @if($user->id==1)
                            <b style="color: darkblue; font-weight: bold;">Admin </b>
                            @else
                          <a href="/delete_user/{{$user->id}}" onclick="confirm('delete user')?true:false;"   style="color: brown; font-weight: bold;">
                           delete <i class="fa fa-trash"></i></a>
                         &nbsp;|&nbsp;
                      <a href="/update_user/{{$user->id}}" style="color: darkblue; font-weight: bold;">
                           Update <i class="fa fa-edit"></i></a>
                         @endif

                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    
                  </div>

                </div>
            </div>
        </div>
      </div>
      <div class="col-md-1 text-center" style="position: fixed; right: 15px;" >
        <ul class="ul_control">
          <li>
            <a href="#users">Users</a>
          </li>
           <li>
            <a href="#settings">Settings</a>
          </li>
           <li>
            <a href="#end">more ...</a>
          </li>
        </ul>
      </div>
    </div>
    </div>
    <!-- //////////////////////////////////////////////////////////////////// -->
   
   <div class="container" style="margin-top: -10px;">
    <div class="row">
      
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Settings</div>
                <div class="panel-body"> 

                  <div class="bs-example" data-example-id="panel-without-body-with-table">
                    <div class="panel panel-default"  >
                      <div class="panel-heading" style="padding: 0px;"> 

                       <form method="post" id="settings" action="/new_setting">
                        {{csrf_field()}}
                        <table class="table control_table" id="control_table" style="margin-bottom: 0px;">
                          <tr>
                            <td>
                              <input type="text" name="sett_name" placeholder="setting title" required 
                              style="border-radius: 5px;">
                            </td>

                            <td>
                              <select class="form-control" name="sett_value" style=" font-size: 14px; font-weight: bold; ">
                                <option value="1">Apply this item for All</option>
                                <option value="0">Stop this item for All</option>
                              </select>

                            </td>

                            <td>
                              <textarea name="sett_desc" placeholder="setting description" style="height:40px; "></textarea>
                            </td>

                            <td>
                              <input type="submit" name="submit" value="Save" class="btn btn-primary" />
                            </td>
                          </tr>
                        </table>
                      </form>

                      </div>
                       <br />
                       <div class="form-control text-center" style="color: darkblue; font-weight: bold;font-size: 18px; background-color: #ddd; border-top: 2px darkblue solid;">Public Settings</div>
                      @foreach($settings as $setting)
                      <form method="post" action="/manage_comments/{{$setting->id}}" >
                           {{csrf_field()}}
                           <table id="control_table" style="width: 100%; padding: 0px;">
                            <tr style="border-bottom: 1px silver solid; border-top: 1px silver solid;">
                            <td class="text-left" style="width: 30%; padding-left: 15px;">
                                <b   style="font-size: 16px;">{{$setting->name}} :</b>
                           </td>
                          <td class="text-center" style="width: 50%; padding: 6px;">
                          <center>
                           <select class=" form-control post-content" name="manage_comment" 
                           onchange="this.form.submit()" 
                         style="width: 70%; font-size: 14px; font-weight: bold; border: 1px; height: 35px; ">
                           <option value="1" {{($setting->value==1)?'selected' : null}}>
                           Apply this item for All</option>
                           <option value="0" {{($setting->value==0)?'selected' : null}}>
                           Stop this item for All</option>
                         </select>
                       </center>
                       </td>
                       <td style="width: 10%;">
                         &nbsp;
                         <a href="/delete_setting/{{$setting->id}}" style="color: brown; font-size: 16px;">
                           delete <i class="fa fa-trash"></i></a>
                       </td>
                     </tr>

                   </table>
                      </form>
                      @endforeach

                      <br />
                      <div class="form-control text-center" style="color: darkblue; font-weight: bold;font-size: 18px; border-top: 2px darkblue solid; background-color: #ddd;">custom Settings</div>

                      <?php $c_c_set=0; ?>
                      @foreach($custom_settings as $setting)
                      @if($c_c_set==0)
                        <?php $c_c_set=1; ?>
                         <table id="control_table" style="width: 100%; padding: 0px;">
                            <tr style="border-bottom: 1px silver solid; border-top: 1px silver solid;">
                            <th class="text-left" style="width: 30%;">Setting
                           </th>
                          <th class="text-center" style="width: 25%;">Owner
                       </th>
                       <th class="text-center" style="width: 25%;">Post title
                       </th>
                       <th style="">
                       <a href="/delete_custom_settings" onclick="confirm('delete all settings')?true:false;" style="color: brown; font-size: 16px;">
                           Delete All <i class="fa fa-trash"></i></a>
                       </th>
                     </tr>
                     </table>
                     @endif
                      <form method="post" action="/manage_comments/{{$setting->id}}" >
                           {{csrf_field()}}
                          <b id="end" style="" name=""></b>
                           <table id="control_table" style="width: 100%; padding: 0px;">
                            <tr style="border-bottom: 1px silver solid; border-top: 1px silver solid;">
                            <td class="text-left" style="width: 30%; padding-left: 15px;">
                                <b   style="font-size: 16px;">{{$setting->name}} </b>
                           </td>
                          <td class="text-center" style="width: 25%; padding: 6px;">
                            <b   style="font-size: 16px;">{{$assoc_users[$setting->user_id]}} </b>
                       </td>
                       <td class="text-center" style="width: 25%;padding: 6px;">
                        <?php $post_title=$assoc_posts[$setting->post_id]; ?>
                             <a  href="/posts/readmore/{{$setting->post_id}}" style="font-size: 16px; color: darkblue;  ">{{$post_title}} </a>
                       </td>
                       <td style="" class="text-center">
                         <a href="/delete_setting/{{$setting->id}}" onclick="confirm('delete all settings')?true:false;"  style="color: brown; font-size: 16px; font-weight: bold;">
                           delete <i class="fa fa-trash"></i></a>
                       </td>
                     </tr>

                   </table>
                      </form>
                      @endforeach



                     </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


<hr />

@endsection



