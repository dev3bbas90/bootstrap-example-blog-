<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

     public function index()
    {

        return view('content.posts');

    }
    
    
    public function control()
    {
      $assoc_users=array();
      $users_data=DB::table('users')->get();
      foreach ($users_data as $user) {
        $assoc_users["$user->id"]=$user->name;
      }
        $assoc_posts=array();
        $posts=DB::table('posts')->get();
      foreach ($posts as $post) {
        $assoc_posts["$post->id"]=$post->title;
      }



        if(Auth::user()->role>2){
            return redirect('/');
        }
        else{
            $users=DB::table('users')->get();
            $settings=DB::table('settings')->where('post_id',0)->get();
            $custom_settings=DB::table('settings')->where('is_admin',0)->get();
            //dd($custom_settings);
        return view('control',compact('users','settings','custom_settings','assoc_posts','assoc_users'));
        }
    }



    public function updateRole(Request $request,User $user){
        $user->update($request->all());
        DB::table('user_role')->where('user_id',$user->id)->update(['role_id'=>$request->role]);
        return redirect('control');
    }

}
