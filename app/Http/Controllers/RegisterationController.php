<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\user;
use App\role;
use Validator;

class RegisterationController extends Controller
{
 function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required|max:55|unique:users',
            'password' => 'required|min:6|confirmed',
            'url' =>'image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);//'profile' => ' image|mimes:jpg,jpeg,png,gif|max:2048'
    }
 //////////////////////////////////////////////register  
public function registerpg(){
  $allow_register=$this::allow_register();
  $log_reg=2;
   if($allow_register==1){
     return view('auth.register',compact('allow_register'));
   }
   else{
    return view('auth.denied_log_reg',compact('log_reg'));
  }
}

public function allow_register(){
      $allow_register_db=DB::table('settings')->where('name','allow register')
      ->where('post_id',0)->value('value');
      $allow_register=0;
      if($allow_register_db==null||$allow_register_db==1){
        $allow_register=1;
      }
      return $allow_register;
 }
//////////////////////////////
public function create_user(Request $request){
 // $validator=$this::validator($request->all());
  
$this->Validate(Request(),[
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required|max:55|unique:users',
            'password' => 'required|min:6|confirmed',
            'url' =>'image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

  // if ($validator->fails()) {
  //           return redirect('/register')
  //                       ->withErrors($validator)
  //                       ->withInput();
  //   }

    $image_name='';
    //dd($request->url);
    if($request->url){
          $image_name=time().'.'.$request->url->getClientOriginalExtension();
          }
        else{
            $image_name='';
          }

  //dd(111);
	$user=new user;
	$user->name=$request->name;
	$user->username=$request->username;
	$user->email=$request->email;
	$user->password=bcrypt($request->password);
  $user->role=$request->role;
	$user->profile=$image_name;

	$user->save();
  if($request->url){
    $request->url->move(public_path('upload/users'),$image_name);
    }

	$rolee='user';
        switch ($request->role) {
            case '1':
               $rolee='admin';
                break;
             case '2':
               $rolee='manager';
                break;
            default:
                $rolee='user';
                break;
        }
    $user->roles()->attach(role::Where('name', $rolee)->first());
    //login

    auth()->login($user);
    //redirect
    return redirect('/posts');
    
}
////////////////////////////////////////////////     end register

}
