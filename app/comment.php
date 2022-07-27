<?php

namespace App;
use App\user;

use Illuminate\Database\Eloquent\Model;
class comment extends Model
{
	// To protect inputs
     protected $fillable=['body','post_id'];
    public function post(){
    	return $this->belongsTo(post::class);
    }
    public function user(){
    	return $this->belongsTo(User::class);
    }
}
