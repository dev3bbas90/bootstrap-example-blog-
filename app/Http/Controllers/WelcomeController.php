<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\post;
use DB;
use App\comment;
use App\category;
use App\like;
use App\user;


class WelcomeController extends Controller
{
    public function statistics(){
    	$users=DB::table('users')->count();
    	$posts_count=DB::table('posts')->count();
    	$comments=DB::table('comments')->count();

    	$posts=DB::table('posts')->get();
    	$posts_users=array();
      $inc=0;
    	foreach ($posts as $k=> $post) {
    		$posts_users[$inc++]=$post->user_id;
    	}
    	 //dd($posts_users);
    	$most_sharable_id=$this->mod($posts_count,$posts_users);
    	 //dd($most_sharable_id);
       $most_sharable='no body';
      if($most_sharable_id !=0){
    	  $most_sharable=DB::table('users')->where('id',$most_sharable_id)->first()->name;
      }
    	$most_commented=user::withCount('comments')->orderBy('comments_count','desc')->first();
    	$most_liked=user::withCount('likes')->orderBy('likes_count','desc')->first();
    	 // $most_shares=user::withCount('user_role')->orderBy('posts_count','desc')->first();
         /////////////////////// for winner 1
    	$likes_count_for_mostComment=DB::table('likes')->where('user_id',$most_commented->id)->count();
    	$shares_count_for_mostComment=DB::table('posts')->where('user_id',$most_commented->id)->count();
    	$most_commented_score=
    	($most_commented->comments_count)+($likes_count_for_mostComment)+($shares_count_for_mostComment);
    	/////////////////////// for winner 2
    	$comments_count_for_most_liked=DB::table('comments')->where('user_id',$most_liked->id)->count();
    	$shares_count_for_most_liked=DB::table('posts')->where('user_id',$most_liked->id)->count();
    	$most_liked_score=($most_liked->likes_count)+($comments_count_for_most_liked);
    	////////////////////////////// for winner 3 sharable
    	$comments_count_for_sharable=DB::table('comments')->where('user_id',$most_sharable_id)->count();
    	$likes_count_for_sharable=DB::table('likes')->where('user_id',$most_sharable_id)->count();
    	$shares_count_for_sharable=DB::table('posts')->where('user_id',$most_sharable_id)->count();
    	$sharable_score=
    	($shares_count_for_sharable)+($likes_count_for_sharable)+($comments_count_for_sharable);
    	$max_score=max($sharable_score,$most_liked_score,$most_commented_score);
    	
    	$max_score_arr_winner=array("$most_liked_score"=>$most_liked->name,"$most_commented_score"=>$most_commented->name,"$sharable_score"=>$most_sharable);
    	$most_active_user=$max_score_arr_winner["$max_score"];
    	
    	
    return view('content.statistics',compact('users','posts_count','comments','most_commented',
    	'most_liked','most_sharable','most_active_user','shares_count_for_sharable'));
}




public function accessDenied(){
    return view('content.accessDenied');
}

 public function mod($count,$numbers)
    {
         $mod_counter=array();
         $max_mod=0;
         if($count>0){
          $co=0;
          $mod_counter[$co]=0;
          $mod_arr=array();
          $mod_arr[$co]=$numbers[0];

        for ($j=0; $j < $count; $j++) { 
          $i=$j;
          $co2=$co;
          if($j>0){
             for ($m=0; $m < count($mod_arr); $m++) { 
                 if($mod_arr[$m]==$numbers[$j]){
                  $i=$count;
                  break;
                 }
              }
            }
              if($i==$j){
                $mod_arr[$co]=$numbers[$j];
                $mod_counter[$co]=0;
                $co++;
              }


          for ($i; $i < $count; $i++) { 
            if($numbers[$i]==$mod_arr[$co2])
            {
              $mod_counter[$co2]++;
            }
          }
         
         }
     }
        
         $max_num=max($mod_counter);
         $index=array_search($max_num, $mod_counter);

         $max_mod=$mod_arr[$index];
      // dd($mod_arr,$mod_counter,'index = ',$index,'max = ',$max_mod);
     return $max_mod;
}



public function about(){
  $categories=DB::table('categories')->get();
  return view('content.about',compact('categories'));
}





}