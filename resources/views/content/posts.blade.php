@extends('layouts.master')

@section('title')
Blog-Posts
@endsection

@section('posts_link')
id='hdr_link_select'
@endsection



@section('content')


<div class="row" id="row-post">
            <!-- Blog Entries Column -->
               <div class="post-content-hdr">
                <h2 class="mind-post">
                    What's on Your mind , {{Auth::user()->name}} ?
                </h2>
                <br />
                @if($allow_share==1)
                <a class="btn btn-primary" href="/make_new_post"> Post any thing... </a>
                @else
                 <b>you can't share posts now !!</b>
                @endif
                <hr class="hr_posts">
                </div>

                <input type="text" id="select_post_id_input" value="" style="display:none;" />
                <!-- First Blog Post -->
                <?php  
                $datetime1 = new DateTime("now");
                $curr_year='';
                foreach ($datetime1 as $value) {
                  $curr_year=substr($value,0,4);
                  break;
                }
                // echo $curr_year;
                ///////////////////////////////////sort posts desc
                 $posts_arr_ma=array();
                 $ssss=count($posts)-1; 
                 foreach ($posts as $k => $post) {
                  $posts_arr_ma[$ssss]=$post;
                  $ssss--;
                 }
                   $inc_posts=0;
                  ?>

                 @foreach($posts as $k=> $postee) 
                  @php
                  $post=$posts_arr_ma[$inc_posts];
                     $inc_posts++;
                  $user_role=Auth::user()->role;
                  @endphp 
                <div class="post-content">
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
                <img class="img-responsive"  src="upload/{{$post->url}}" alt="Ther is an image here..">
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
                 <div class="col-md-3" >
                    <a class="{{$like_status}} fa-thumbs-up like_div" type="button" 
                     data_like="{{$like_status}}" data_postid="{{$post->id}}"
                     style="color:{{$like_color}};" alt='Like'> Like</a>
                      &nbsp; <small data_postid_count="{{$post->id}}">
                        (<span class="like_count">{{$like_count}}</span>)</small>
                 </div>
                  <!-- //////////////////////////////////////////// dislike -->
                 <div class="col-md-3" >
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
               <div id="comments_list">
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
                <b><?php echo html_entity_decode($comment->body); ?> </b></p>
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
                    <form class="form-horizontal" role="form" method="POST" id="comment_table"
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
                <div id="comment_table">
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
               
                <!-- Pager -->
                <div class="text-center">
                    
                        <a href="#" style="font-size: 18px;"> See more ...</a>
                    
                    
                </div>

            </div>

        
@stop