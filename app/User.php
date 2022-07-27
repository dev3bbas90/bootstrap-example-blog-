<?php

namespace App;
use App\role;
use App\comment;
use App\post;
use DB;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password','role','username','profile'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
     public function roles(){
    	return $this->belongsToMany('App\user','user_role','user_id','role_id');
    }

    public function likes(){
        return $this->hasmany(like::class);
    }

    public function comments(){
        return $this->hasmany(comment::class);
    }

    public function post(){
        return $this->belongsTo(post::class);
    }
    ////////////////////////  Manual Roles 
    public function hasAnyRoles($roles){
        // array || single role
        if(is_array($roles)){
            foreach ($roles as $role){
                if($this->hasRole($role)){
                    return true;
                }
            }
        }
        else{
            if($this->hasRole($roles)){
                    return true;
                }
        }
    }
    
    public function hasRole($role)
    {
        // if($this->roles()->where('name',$role)->first())
        $ch=DB::table('roles')->where('name',$role)->value('id');  //1
        $user_role=DB::table('user_role')->where('role_id',$ch )->where('user_id',$this->id)->value('id');  //&& 'user_id',$this->id
         if($user_role)
        {
            return true;
        }
         return false;
          // return view($user_role);
    }
    //////////////////////////////////////////
    
    
    
}
