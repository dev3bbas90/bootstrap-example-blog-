@extends('layouts.master')

@section('title')
Category-Posts
@endsection

@section('posts_link')
id='hdr_link_select'
@endsection

@section('content')


<div class="row" id="row-post">
            <!-- Blog Entries Column -->
               <div class="post-content-hdr">
                <?php
                 $posts_arr_ma=array();
                 $ssss=count($posts)-1; 
                 foreach ($posts as $k => $post) {
                  $posts_arr_ma[$ssss]=$post;
                  $ssss--;
                 }
                   $inc_posts=0;
                ?>
                <h2 class="mind-post">
                 
                  @if(count($posts))
                @foreach($posts as $post)
                  Posts of <a href="#"> <strong>{{$post->category->name}}</strong></a> Category .
                  @break;
                  @endforeach
                  @else
                  <strong>No posts Belong To this Category ... </strong>
                  @endif
                </h2>
                <br />
                <form method="post" action="/category/search_category">
                  {{ csrf_field() }}
                <div class="input-group" style="width: 50%;">
                        <input type="text" class="form-control" name="name" placeholder="search another category ...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                </form>
                <hr class="hr_posts">
                </div>
                
                <!-- First Blog Post -->


               @if(count($posts)) 
                @foreach($posts as $post)
                 @php
                   $post=$posts_arr_ma[$inc_posts];
                     $inc_posts++;

                  $user_role=Auth::user()->role;
                  $datetime1 = new DateTime("now");
                $curr_year='';
                foreach ($datetime1 as $value) {
                  $curr_year=substr($value,0,4);
                  break;
                 }
                      $poster_id=$post->user_id;
                      $poster_name=$users_id_name["$poster_id"];
                      $select_post_id='select_post'.$post->id;
                     $profile=$users_id_prof[$poster_id];
                  @endphp
                <div class="post-content">
                <h2>
                    <a href="/posts/readmore/{{$post->id}}">{{$post->title}}</a>
                    
                   </h2>
                   <div class="l-post-user">
                   @if($profile=='')
                    <image src="/upload/users/1579868173.png" id='' alt="default profile" class="user-post-img" />
                   @else
                    <image src="/upload/users/{{$profile}}" alt="user profile" class="user-post-img" />
                  @endif

                 </div>
                 <div class="r-post-u ser">
               <?php 
                     //////////////////////////////////////
                      $datetime_post = $post->created_at;
                     $interva_post = date_diff($datetime_post, $datetime1);
                     $time_p=$post->created_at->toDayDateTimeString();
                     //var_dump($time_p);
                     $post_date_e=substr($time_p, 5,5);
                     $year=substr($time_p , 12,5);
                     $post_time_e=substr($time_p, 18);
                     $year=str_replace(' ', null, $year);
                   ?>
                <p class="lead" id="by_name">by <a href="/profile/{{$poster_id}}">{{$poster_name}}</a></p>
                <p id="post_date"><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->toDayDateTimeString()}}&nbsp;
                </p>
                </div>
                @if($post->url != null)
                <!-- <hr class="hr_posts"> -->
                <img class="img-responsive"  src="../upload/{{$post->url}}" alt="Ther is an image here..">
                @endif
               <!--  <hr> -->
                <p class="post-body" id="post_body">@php echo nl2br($post->body) @endphp</p>
                <a class="btn btn-primary" href="/posts/readmore/{{$post->id}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
               </div>
               <!-- comments list  -->
               @if(count($post->comments))
               <div id="comments_list">
                <b style="display: none;">{{$c=0}}</b>
                <b>Comments : </b>
                @foreach($post->comments as $comment)
                <b style="display: none;">{{$c++}}</b>
               <p class="commenti"> <a href=""><b> {{Auth::user()->name}} &nbsp;</b></a> {{$comment->body}} </p>
               @if($c==2&&count($post->comments)>2)
               <a href="/posts/readmore/{{$post->id}}" id="readmorecomments">More Comments ... </a>
               @break
               @endif
                 @endforeach
              
               </div>
               @endif
               <!-- comment Form  -->
                    <form class="form-horizontal" role="form" method="POST" id="comment_table"
                     action="/posts/{{ $post->id}}/saveComment">
                        {{ csrf_field() }}
                         <input type="text" name="user_id" value="{{auth::user()->id}}" style="display: none;" />
                        <table style="width: 100%;"><tr><td style="width:80%;">
                           <input type="text" id="comment_form" name="body" style="width: 100%;"
                           @if(count($post->comments))
                           placeholder='Write Your  comment Here ... ' 
                           @else
                           placeholder='Be The First to   comment Here ... '  
                           @endif
                           >
                         </td><td>
                         <button type="submit" class="btn btn-primary" style="display: none;">
                                    <i class="fa fa-btn fa-sign-in"></i> Submit Comment
                                </button>
                    </td></tr></table>
                </form>
               <br />
                @endforeach

                <!-- Pager -->

                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

         @else
          <div class="post-content">
                <h1>There's No Posts in this Category !!</h1>
          </div>
         @endif

            </div>

         
@stop