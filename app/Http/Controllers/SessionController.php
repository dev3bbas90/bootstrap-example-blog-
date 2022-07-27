<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use DB;
use App\user;

use App\post;
use App\comment;
use App\category;
use App\like;
use App\setting;

class SessionController extends Controller
{
  
public function loginpg(){
  $allow_login=$this::allow_login();
  $log_reg=1;
  return view('auth.login',compact('allow_login'));
}
  
 public function allow_login(){
      $allow_login_db=DB::table('settings')->where('name','allow login')
      ->where('post_id',0)->value('value');
      $allow_login=0;
      if($allow_login_db==null||$allow_login_db==1){
        $allow_login=1;
      }
      return $allow_login;
 }

public function login(Request $request){
	//array $credentials = [], $remember = false, $login = true  // video error
	$allowed=$request->allowed;
	$user_role=DB::table('users')->where('username',$request->username)->value('role');
	if($user_role==1||$allowed==1){

	$arr=array('username'=>$request->username,'password'=>$request->password);
  if(! auth()->attempt($arr,false,true ))
  {
  	return back()->withErrors([
  		'message'=>'Sorry , Your username or password don\'t match !! ']);
  }
  else{
  	return redirect('/posts');
  }
}
else{
	$log_reg=1;
     return view('auth.denied_log_reg',compact('log_reg'));
 }

}


public function logout(){
	auth()->logout();
	return redirect('/');
}


public function switch_user(){
  auth()->logout();
  return redirect('/login');
}


public function delete_user(user $user_id){
  // dd($user_id->id);
  $user_id->delete();
   DB::table('user_role')->where('user_id',$user_id->id)->delete();
   DB::table('likes')->where('user_id',$user_id->id)->delete();
   DB::table('comments')->where('user_id',$user_id->id)->delete();

   return back();
}


public function save_updates(){
   DB::table('likes')
           ->where('post_id',$post_id)
          ->Where('user_id',$user_idd)
         ->update(['like'=>1]); 
     }
/////////////////////////////////////////////////////
public function update_user(user $user_id){
  $user=$user_id;
 return view('auth.update_user',compact('user'));
}
////////////////////////////////////

public function save_update_user(request $request,$user_id){
  $this->Validate(Request(),[
            'name' => 'max:255',            
            'password' => 'min:6',
            'url' =>'image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);
 $curr_user=DB::table('users')->Where('username',$request->username)->value('id');
 $curr_email=DB::table('users')->Where('email',$request->email)->value('id');

 if($curr_user!=$user_id){
  $this->Validate(Request(),[
            'email' => 'required|email|max:255|unique:users'
                ]);
 }
 elseif($curr_email!=$user_id){
    $this->Validate(Request(),[
            'email' => 'required|email|max:255|unique:users'
        ]);
 }
 else{
  
 }

 $curr_profile=DB::table('users')->Where('id',$user_id)->value('profile');
 $curr_password=DB::table('users')->Where('id',$user_id)->value('password');
   //dd($curr_pass,sha1($curr_pass),sha1($request->oldpassword));
 $password=$curr_password;
 if($request->password=='nullll'||$request->password==''){
 $password=$curr_password;
 //dd('null');
 }
 else{
  $password=bcrypt($request->password);
 }
 //$profile=$request->url_text;

 $image_name=$curr_profile;
 $is_new_prof=0;
 if($request->url&&$image_name==''){
          $image_name=time().'.'.$request->url->getClientOriginalExtension();
          $is_new_prof=1;
          }
  //dd($request->url);
  DB::table('users')
           ->where('id',$user_id)
           ->update(['name'=>$request->name,
          'username'=>$request->username,
          'email'=>$request->email,
          'profile'=>$image_name,
          'role'=>$request->role,
          'password'=>$password,
       ]); 

   if($request->url){
    $request->url->move(public_path('upload/users'),$image_name);
    }
    DB::table('user_role')->Where('user_id',$user_id)->update(['role_id'=>$request->role]);
  if(auth::user()->role==1){
    return redirect('/control');
  }
  else{
    return redirect('/posts');
  }
  
 }

/////////////////////////////////////////////////////

function update_my_profile(){
   $user=DB::table('users')->where('id',auth::user()->id)->first();
 return view('auth.update_my_profile',compact('user'));
}

function save_update_my_profile(request $request){
  $user_id=auth::user()->id;
  $this->Validate(Request(),[
            'name' => 'max:255',            
            'password' => 'min:6',
            'url' =>'image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);
 $curr_user=DB::table('users')->Where('username',$request->username)->value('id');
 $curr_email=DB::table('users')->Where('email',$request->email)->value('id');

 if($curr_user!=$user_id){
  $this->Validate(Request(),[
            'email' => 'required|email|max:255|unique:users'
                ]);
 }
 elseif($curr_email!=$user_id){
    $this->Validate(Request(),[
            'email' => 'required|email|max:255|unique:users'
        ]);
 }else{}
 $curr_profile=DB::table('users')->Where('id',$user_id)->value('profile');
 $curr_password=DB::table('users')->Where('id',$user_id)->value('password');
 $password=$curr_password;
 if($request->password=='nullll'||$request->password==''){
 $password=$curr_password;
 }
 else{
  $password=bcrypt($request->password);
 }
 $image_name=$curr_profile;
 $is_new_prof=0;
 if($request->url&&$image_name==''){
          $image_name=time().'.'.$request->url->getClientOriginalExtension();
          $is_new_prof=1;
          }
  DB::table('users')
           ->where('id',$user_id)
           ->update(['name'=>$request->name,
          'username'=>$request->username,
          'email'=>$request->email,
          'profile'=>$image_name,
          'password'=>$password,
       ]);

   if($request->url){
    $request->url->move(public_path('upload/users'),$image_name);
    }
    // DB::table('user_role')->Where('user_id',$user_id)->update(['role_id'=>$request->role]);
 
    return redirect('/profile/'.$user_id);  
 }

///////////////////////////////////////////////////////



 
//////////////////////////////////////////   end class
}

