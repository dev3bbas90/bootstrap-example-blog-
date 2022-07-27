<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\post;
use App\comment;
class commentsController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function saveComment(post $post,Request $request){
       $this->validate(Request(),[
       	'body'=>'required']);
        $comment=new comment;
        $comment->body=htmlentities(request('body'));
        $comment->post_id=$post->id;
        $comment->user_id=request('user_id');
        $comment->save();

        // comment::create([
        // 	'body'=>request('body'),
        // 	'post_id'=>$post->id
        // ]);
        return back();

   }
}
