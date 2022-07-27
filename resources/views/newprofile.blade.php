@extends('layouts.master')

@section('title')
User-profile
@endsection


@section('hide_sidebar')
id='hide_sidebar'
@endsection


@section('posts_link')
id='hdr_link_select'
@endsection

@section('content')
@php
$accoss_role=array(1=>'admin',2=>'manager',3=>'user');
foreach ($posts_arr as $key => $value){
  $$key=$value;
}
@endphp

<div class="container" style="margin-top: -10px;">
    <div class="row">
        <div class="col-md-14 ">
            <div class="panel panel-default" style="border-style: none;">
                <div class="panel-heading" style="margin-bottom: 8px; margin-left: -12px; ">
                  <div class="row" >
                     <div class="col-md-4 text-left" style="font-size: 16px; font-weight: bold;">
                       {{$accoss_role[$user->role]}} :
                      <br />
                      <b style="color: darkblue;">  {{$user->name}}</b>
                     @if($user->id==Auth::user()->id)
                      <br />
                      <b style="">  {{$user->email}}</b>
                      @endif
                      </div>
                      <div class="col-md-4 text-center">
                         
                         @if($user->id==Auth::user()->id)
                            <b>My Profile</b><br />
                            <a href="/update my profile" class="btn btn-primary">Update Profile</a>
                            @else
                            <br /> <b style="color: darkblue;">{{$user->name}} Profile</b>
                          @endif
                      </div>
                       <div class="col-md-4 text-right">
                         <img src="/upload/users/{{$user->profile}}" style="width: 80px; height: 80px; border-radius: 15px;">
                      </div>
                    </div>

                </div >
                <!-- //  content  -->
                  <div class="row">
                    <div class="col col-sm-3 " style="padding: 1px;">

                       <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group col-lg-11">
                     <form method="post" action="/category/search_category" >
                            {{ csrf_field() }}
                        <input type="text" id="search_cat" name="name" class="form-control" style=" width:80%; float: left;" placeholder="search By Category name" >
                        <span class="input-group-btn">
                             <button class="btn btn-default" type="submit" >
                                <span class="glyphicon glyphicon-search"></span>
                             </button>
                        </span>
                    </form>

                    </div>
                    <!-- /.input-group -->
                </div>


                    
                        
                         <div class="well" style="color: darkblue; font-weight: bold;">
                        <strong style="font-size: 14px; font-weight: bolder; color: black;">Categories :</strong>
                         
                          <ul class="list-unstyled cat_list">
                            @if(isset($categories))
                             @foreach($categories as $cat)
                              <li><a href="../category/{{$cat->name}}">{{$cat->name}} Category</a></li>
                              @endforeach
                            @else
                            <li><a href="../category/network">Network Category</a></li>
                            <li><a href="../category/web">Web Category</a></li>
                            <li><a href="../category/Mobile">Mobile Category</a></li>
                            <li><a href="#">New Category </a></li>
                            @endif
                            </ul>
                         </div>
                    

                       <div class="well">
                        <b class="title">A Word  about  our Project</b>
                        <a href="/" style="font-weight: bold; color: darkblue;"> Blog </a>
                        : <br />
                         <b> 
                          <strong>Blog</strong> web Application Provides You 
                          Share Your researches , articles or any thing related
                          with your Field . 
                          It also save your data privacy as no one 
                          can see or edit your information but you.

                            </b>
                         </div>
                    </div>

                    <div class="col col-sm-9">
                    
                
                  <!-- ///////////////////////////////////////////////////   start posts -->
                  <?php  
                $datetime1 = new DateTime("now");
                $curr_year='';
                foreach ($datetime1 as $value) {
                  $curr_year=substr($value,0,4);
                  break;
                }
                 $posts_arr_ma=array();
                 $ssss=count($posts)-1; 
                 foreach ($posts as $k => $post) {
                  $posts_arr_ma[$ssss]=$post;
                  $ssss--;
                  }
                  $ssss=0;
                  ?>

                 @foreach($posts as $k=> $postee) 
                  @php
                  $post=$posts_arr_ma[$ssss++];

                  $user_role=Auth::user()->role;
                  @endphp 
                <div class="post-content timeline_div">
                  <div class="row">
                    <div class="col col-md-8">
                <h2>
                    <a href="/posts/readmore/{{$post->id}}">{{$post->title}}</a>
                    <small> &nbsp; (
                  <a href="./category/{{$post->category->name}}">{{$post->category->name}}</a> )
                   </small>

                </h2>
              
                     <!-- Post user & data  -->
                     @php
                     $poster_id=$post->user_id;
                      $poster_name=$users_id_name["$poster_id"];
                      $select_post_id='select_post'.$post->id;

                     $profile=$users_id_prof[$poster_id];
                     @endphp
                <div class="l-post-user">
                @if($profile=='')
                <image src="/upload/users/1579868173.png" id='' class="user-post-img" />
                @else
                <image src="/upload/users/{{$profile}}" id='' class="user-post-img" />
                @endif
                <!-- <image src="upload/car1.jpg" id='' class="user-post-img" /> -->
                 </div>
                 <div class="r-post-user">
                  <?php 
                      $datetime_post = $post->created_at;
                     $interva_post = date_diff($datetime_post, $datetime1);
                     $time_p=$post->created_at->toDayDateTimeString();
                     //var_dump($time_p);
                     $post_date_e=substr($time_p, 5,5);
                     $year=substr($time_p , 12,5);
                     $post_time_e=substr($time_p, 18);
                     $year=str_replace(' ', null, $year);
                     //echo $post->created_at->toDayDateTimeString();
                   ?>
                <p class="lead" id="by_name"><a href="/profile/{{$poster_id}}">{{$poster_name}}</a></p>
                <p id="post_date"><span class="glyphicon glyphicon-time"></span> 
                  @if($year != $curr_year)
                     {{$year}} ,
                  @endif

                  @if($year==$curr_year&&$interva_post->m==0&&$interva_post->d==0&&$interva_post->h==0)
                  just now.
                  @else
                 @if($interva_post->d>1)
                  {{$post_date_e}}
                  @elseif($interva_post->d==1)
                    yesterday
                  @else
                    Today
                @endif
               , AT: {{$post_time_e}}
               @endif
                  <!-- {{$post->created_at->toDayDateTimeString()}} -->
                  &nbsp;
                </p>
                </div>
                 <!-- End Post user & data  -->
              </div>  <!-- End col1 div  -->
               
               <!--  col2 div ...  -->
                <!-- ////////////////////////////////////////// ul -->
              <div class="col-md-3 text-right" style="margin-top: 15px; float:right;">
                <input type="text" value="0" id="select_show_var">
                <b id="select_post_b"  onclick="select_post_show({{$post->id}})">...</b>
                  @if(Auth::user()->id==$poster_id||$user_role==1)
                <ul class="dropdown-content2 text-left select_post" dir="ltr" id="{{$select_post_id}}" style="display:none; ">
                 <li><i class="fa fa-arrow-right"></i>&nbsp;
                  <a href="/edit post/{{$post->id}}/2020">&nbsp; Edit Post&nbsp; <i class="fa fa-edit"></i></a>
                </li>
                  <li><i class="fa fa-arrow-right"></i>&nbsp;<a href="/delete_post/{{$post->id}}">&nbsp; delete Post&nbsp; <i class="fa fa-trash"></i></a></li>
                  <li><i class="fa fa-arrow-right"></i>&nbsp;<a href="">&nbsp; stop share</a></li>
               </ul>
                  @endif
             </div>
             <!-- //////////////////////////////////////////////////// end ul -->
              </div>
              <hr class="separator_5">
                @if($post->url != null)
                <!-- <hr class="hr_posts"> -->
                <img class="img-responsive"  src="/upload/{{$post->url}}" alt="Ther is an image here..">
                @endif
               <!--  <hr> -->
                <p class="post-body" id="post_body">@php echo nl2br($post->body) @endphp</p>
               <a class="btn btn-primary" href="/posts/readmore/{{$post->id}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                
                
                <div id="likedislike" >

                  @php
                  $like_count=$dislike_count=0;
                  $like_status=$dislike_status='far';
                  $like_color=$dislike_color='#272626'; 
                  @endphp

                  @foreach($post->likes as $like)

                  @php
                  if(Auth::check()){
                  if($like->like){$like_count++;}
                  else{$dislike_count++;}

                  if($like->like&&$like->user_id==Auth::user()->id)
                  {
                    $like_status='fa';
                    $like_color='#337ab7';
                  }
                  if(!$like->like&&$like->user_id==Auth::user()->id)
                  {
                    $dislike_status='fa';
                    $dislike_color='#337ab7';
                  }
                  }
                  @endphp
                  @endforeach
                  <!-- //////////////////////////////////////////  Like -->
                 <div class="col-md-3 " >
                    <a class="{{$like_status}} fa-thumbs-up like_div" type="button" 
                     data_like="{{$like_status}}" data_postid="{{$post->id}}"
                     style="color:{{$like_color}};" alt='Like'> Like</a>
                      &nbsp; <small data_postid_count="{{$post->id}}">
                        (<span class="like_count">{{$like_count}}</span>)</small>
                 </div>
                  <!-- //////////////////////////////////////////// dislike -->
                 <div class="col-md-3 " >
                    <a class="{{$dislike_status}} fa-thumbs-down dislike_div" type="button" alt='disLike' data_dislike="{{$dislike_status}}" data_postid2="{{$post->id}}"  style="color:{{$dislike_color}};"> dislike</a>&nbsp;<small data_postid_count2="{{$post->id}}"> 
                      (<span class="dislike_count"> {{$dislike_count}} </span>)</small>
                  </div>
                  <!-- //////////////////////////////////////////// comment -->
                 <div class="col-md-6" id="hide_comments_div" onclick="hide_comments_div()"><a href="/posts/readmore/{{$post->id}}#comment_form">Comment <i class="fa fa-comment" ></i></a>
                  &nbsp;<small> ( {{count($post->comments)}} ) comments.</small>
                </div>
                  <!-- ////////////////////////////////////////////  -->
                <hr class="hr_posts2">
              </div>

                <!-- <button type="button" class="btn btn-success"></button>
                <button type="button" class="btn btn-danger">dislike</button> -->
               </div>
                 <?php
                $user_allow_comments_var=1;
               if(isset($user_allow_comments[$post->id])){
                $user_allow_comments_var=$user_allow_comments[$post->id];
              }
                ?>
               <!-- comments list  -->
               @if(count($post->comments))
               <div id="comments_list" class="timeline_div" style="">
                <input type="text" value="1" id="comments_list_show_ch" style="display: none;">
                <b style="display: none;">{{$c=0}}</b>
                  <div class="row">
                    <div class="col-md-6">
                    <b id="comments_title">Comments : </b>
                    </div>
                    <div class="col-md-6 text-right">

                     
                    @if(count($post->comments)>0&&$allow_comment==1&&($post->user_id==auth::user()->id||$user_role==1))
                       @if($user_allow_comments_var==1)
                        <a href="/stop_comment_post/{{$post->id}}_{{Auth::user()->id}}" id="comments_title"> stop comments </a>
                        @else
                        <a href="/stop_comment_post/{{$post->id}}_{{Auth::user()->id}}" id="comments_title"> Apply comments </a>
                        @endif
                    @endif
                    </div>
                  </div>

                @foreach($post->comments as $comment)
                <?php
                 $datetime2 = $comment->created_at;
                  $interval = date_diff($datetime2, $datetime1);
                  
                 $commenter_id=$comment->user_id;
                 $commenter_name=$users_id_name[$commenter_id];
                 ?>
                 <div class="ccoment">
                <b style="display: none;">{{$c++}}</b>
               <p class="commenti"> <a href="/profile/{{$commenter_id}}"><b> {{$commenter_name}} </b></a>
                 <small>  <span class="glyphicon glyphicon-time"></span></small>
             @if($interval->d>1)
                <small> ({{$interval->format('%a days')}})</small>
               @elseif($interval->d==1)
               <small>yesterday</small>
               @else
               <small>Today</small>
               @endif
               <br />

               <div class="row">
                <div class="col-md-8">
                <b>{{$comment->body}} </b></p>
                </div>
                <div class="col-md-4 text-right">
                  <!-- //////////////////////////////////////delete -->
                @if(($allow_comment==1&&$commenter_id==auth::user()->id)||auth::user()->role==1)
                <a href="/deletecomment/{{$comment->id}}" style="color: brown;">&nbsp;delete <i class="fa fa-trash"></i>&nbsp;</a>
                @endif 

              </div>
            </div>
          </div>
               @if($c==2&&count($post->comments)>2)
               <a href="/posts/readmore/{{$post->id}}" id="readmorecomments">More Comments ... </a>
               @break
               @endif
                 @endforeach
              
               </div>
              @endif

              
               <!-- comment Form  -->
               @if($allow_comment==1&&$user_allow_comments_var==1)
                    <form class="form-horizontal timeline_div" role="form" method="POST" id="comment_table"
                     action="/posts/{{ $post->id}}/saveComment">
                        {{ csrf_field() }}
                      <input type="text" name="user_id" value="{{auth::user()->id}}" style="display: none;" />
                        <table style="width: 100%;">
                          <tr><td style="width:80%;">
                           <input type="text" id="comment_form" name="body" style="width: 100%;"
                           @if(count($post->comments))
                           placeholder='Write Your  comment Here ... ' 
                           @else
                           placeholder='Be The First to   comment Here ... '  
                           @endif
                           >
                         </td><td class="text-right">
                         <button type="submit" class="btn btn-primary" style="display: none;">
                                    <i class="fa fa-btn fa-sign-in"></i> Submit Comment
                                </button>
                                
                      @if(count($post->comments)==0 && 
                         $allow_comment==1  &&
                         ($post->user_id==auth::user()->id||$user_role==1))
                          
                          

                          @if($user_allow_comments_var==1)
                        <a href="/stop_comment_post/{{$post->id}}_{{Auth::user()->id}}" id="comments_title"> stop comments </a>
                         @else
                        <a href="/stop_comment_post/{{$post->id}}_{{Auth::user()->id}}" id="comments_title"> Apply comments </a>
                        @endif
                        @endif

                         
                    </td></tr></table>
                </form>
                @else
                <div id="comment_table" class="timeline_div">
                  <table style="width:98%;"><tr><td class="text-left">
                  <b>sorry , comments is currently Closed !!</b>
                </td>
                <td class="text-right">

                    @if(count($post->comments)==0&&$allow_comment==1&&($post->user_id==auth::user()->id||$user_role==1))
                           @if($user_allow_comments_var==1)
                        <a href="/stop_comment_post/{{$post->id}}_{{Auth::user()->id}}" id="comments_title"> stop comments </a>
                         @else
                        <a href="/stop_comment_post/{{$post->id}}_{{Auth::user()->id}}" id="comments_title"> Apply comments </a>
                        @endif
                        @endif
                      </td>
                    </tr>
                  </table>


                </div>
                @endif
               <br />
               

             @endforeach


             @if(count($posts)==0)
             <div class="post-content timeline_div" style="text-align: center; height: 300px;">
             <h1> {{$user->name}} don't have posted any thing here .</h1>

              <br /><br /><br />
              @if($user->id==Auth::user()->id)
               <a href="/make_new_post" class="btn btn-primary">Post any thing</a>
               @endif

             </div>
             @endif



               
                  <!-- /////////////////////////////////////////////////// end posts -->
               
                    </div>
                  </div>
                    <!-- /////////////////////////////////////////////////// end divs -->
        </div>
    </div>
</div>
@endsection


