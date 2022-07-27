<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class post extends Model
{
    protected $fillable=[
    	'title','body','url'
    ];

    public function comments(){
    	return $this->hasmany(comment::class)->orderBy('created_at');
    }

     public function category(){
    	return $this->belongsTo(category::class);
    }

    public function likes(){
    	return $this->hasmany(like::class);
    }

    public function users(){
        return $this->hasmany(user::class);
    }

}
