<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use App\Http\Request;
use App\post;
use DB;
use App\comment;
use App\category;
use App\like;
use App\user;
use App\setting;

class pagesController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');

    }
    
    public function allow_comment(){
      $allow_comment_db=DB::table('settings')->where('name','allow comments')
      ->where('post_id',0)->value('value');
      $allow_comment=0;
      if($allow_comment_db==null||$allow_comment_db==1){
        $allow_comment=1;
      }
      return $allow_comment;
    }
/////////////////////////////////////////// share
    public function allow_share(){
      $allow_comment_db=DB::table('settings')->where('name','Allow shares')
      ->where('post_id',0)->value('value');
      $allow_share=0;
      if($allow_comment_db==null||$allow_comment_db==1){
        $allow_share=1;
      }
      return $allow_share;
    }

    //////////////////////////////////////////
    public function allow_some_posts_comment(){
      $allow_comment_db=DB::table('settings')
      ->where('is_admin',0)->get();
      //dd($allow_comment_db);
      $post_value_arr=array();
      foreach ($allow_comment_db as $row) {
        $post_value_arr[$row->post_id]=$row->value;
      }
      return $post_value_arr;
    }

///////////////////////////////////////////////////
    public function get_categories(){
       return DB::table('categories')->get();

    }
    ///////////////////////////////////////////
     function posts(){
      $posts=post::all();
      $categories=DB::table('categories')->get();
      $users_data=DB::table('users')->get();
      $user_allow_comments=$this::allow_some_posts_comment();
      $users_id_name=array();
      $users_id_prof=array();
      foreach ($users_data as $user) {
        $users_id_name["$user->id"]=$user->name;
        $users_id_prof["$user->id"]=$user->profile;
      }
      //dd($users_id_name);
      $allow_comment=$this::allow_comment(); 
    	$allow_share=$this::allow_share(); 

    	return view('content.posts',compact('posts','allow_share','allow_comment','users_id_name','user_allow_comments','users_id_prof','categories'));
    }
    ////////////////////////////////////////////

    public function onepost($post){
     $ch_post=DB::table('posts')->where('id',$post)->get();
     if(!$ch_post){
      return redirect('/posts');
     }
     else{

     $all_post=post::all();
     foreach ($all_post as $value) {
      if($value->id==$post){
       $post=$value;
       break;
      }
     }
      // $posts=post::all()->where('id',$post->id);
      $users_data=DB::table('users')->get();
      $categories=DB::table('categories')->get();
      $users_id_name=array();
      $users_id_prof=array();
      foreach ($users_data as $user) {
        $users_id_name["$user->id"]=$user->name;
        $users_id_prof["$user->id"]=$user->profile;
      }
      $post_found=1;
      $allow_comment=$this::allow_comment(); 
      $allow_share=$this::allow_share(); 
     if($users_data){
      $user_allow_comments=$this::allow_some_posts_comment();
      $users_id_name=array();
      foreach ($users_data as $user) {
        $users_id_name["$user->id"]=$user->name;
      }

     return view('content.read_post',compact('allow_share','post_found','post','allow_comment','users_id_name','user_allow_comments','categories','users_id_prof','users_id_name'));
     }
     else{
      $post_found=0;
     return view('content.read_post',compact('allow_share','post_found','categories'));
     }
   }
  }

 public function create_post(){
        $categories=category::all();
        $allow_share=$this::allow_share(); 
       return view('content.new_post',compact('allow_share','categories')); 
  }
    
   
    public function store(Request $request){
    	$this->Validate(Request(),[
            'title' => 'required|max:25|min:6',
            'body' => 'required|max:280',
            'category_id' => 'required',
            'url' => ' image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        $image_name='';
        if($request->url){
    	    $image_name=time().'.'.$request->url->getClientOriginalExtension();
          }
        else{
            $image_name='';
          }


          $category_id=request('category_id');
          $category_name=request('new_category');
          if(request('category_id')=='new_category')
          {
            $this->Validate(Request(),[
            'new_category' => 'required|max:25|min:3',
               ]);
            $cat_id=$this::new_category($category_name);
            if($cat_id !=0){
            $category_id=$cat_id;
            }
          }
    	        $post=new post;
    	        $post->title=request('title');
    	        $post->body=htmlentities(request('body'));
    	        $post->url=$image_name;
              $post->category_id=$category_id;
              $post->user_id=Auth::user()->id;
             	// post::create([
             	// 	'title'=>$request->title,
              //        'body' => $request->body,
              //        'url' =>$image_name
             	// ]);
             	$post->save();
             if($request->url){
                $request->url->move(public_path('upload'),$image_name);
               } 
       return redirect('../posts');
    }
 
    function new_category($category_name){
      $is_found_cat= DB::table('categories')->where('name',$category_name)->value('id');
      if($is_found_cat==null){
      $new_cat_id= DB::table('categories')->latest()->value('id')+1; 
      $cat=new category;
      $cat->id=$new_cat_id;
      $cat->name=htmlentities($category_name);
      $cat->discription='';
      if($cat->save()){
        return $new_cat_id;
      }
      else{
        return 0;
       }
      }
      else{
        return $is_found_cat;
      }
      

    }

    public function category($name){
        $categories=DB::table('categories')->get();
        $cat=DB::table('categories')->where('name',$name)->value('id');
      if($cat){
        $posts=[];
        $posts=post::all()->where('category_id',$cat);
        //dd($posts);
        
      $users_data=DB::table('users')->get();
      $users_id_name=array();
      $users_id_prof=array();
      foreach ($users_data as $user) {
        $users_id_name["$user->id"]=$user->name;
        $users_id_prof["$user->id"]=$user->profile;
      }
      $post_found=1;
      $allow_comment=$this::allow_comment(); 
      $allow_share=$this::allow_share(); 
     if($users_data){
      $user_allow_comments=$this::allow_some_posts_comment();
      }
     return view('content.category',compact('posts','categories','allow_share','allow_comment','user_allow_comments','users_id_name','users_id_prof'));
      }
      else{
        return redirect('/posts');
      }
    }

    public function category_2($name){
        return redirect('/category/'.$name);
    }

public function categorySearch(Request $request){
       $name=request('name');
       $cat=DB::table('categories')->where('name',$name)->value('id');
       if($cat){
        return redirect("/category/$name");
       }
       else{
        return redirect('/posts');
       }
    
}

////////////////////////////////////////////////////////////Roles

// public function register(Request $request){
//     $user=new user;
//     $use->name=$request->name;
//     $use->username=$request->username;
//     $use->email=$request->email;
//     $use->password=bcrypt($request->password);
//     $use->role=$request->role;
//     $user->save();
  
//    $user->roles()->attach(role::Where('name','User')->first());
//    auth()->login($user);
//    return redirect("/posts");
// }

//////////////////////////////////////////////////////////
public function manager(){
    return view('content.manager');
}



public function like(Request $request){
    // $like_status=$request->like_s;
    $user_idd=auth::user()->id;
     $post_id=$request->post_id;

    $like=DB::table('likes')->where('post_id',$post_id)->Where('user_id',$user_idd)->first();
    // $like=DB::table('likes')->where('post_id',$post_id)->Where('user_id',1)->first();
     // result
    //Auth::user()->id 
    $is_like=1; $swapped=0;
    if(!$like){
        $new_like=new like;
        $new_like->post_id=$post_id;
        $new_like->user_id=$user_idd;
        $new_like->like=1;
        $new_like->save();
       } 
       elseif($like->like==1) {
           DB::table('likes')
           ->where('post_id',$post_id)
          ->Where('user_id',$user_idd)
         ->delete(); 
         $is_like=0;
        } 
        else{ //if($like->like==0)
           DB::table('likes')
           ->where('post_id',$post_id)
          ->Where('user_id',$user_idd)
         ->update(['like'=>1]); 
         $swapped=1;
       }
       $json_result=array('is_like' => $is_like,'swapped'=>$swapped);
       return response()->json($json_result,200);
  }

public function dislike(Request $request){
    $user_idd=auth::user()->id;
     $post_id=$request->post_id;

    $like=DB::table('likes')->where('post_id',$post_id)->Where('user_id',$user_idd)->first();
    $is_dislike=1;
    $swapped=0;
    if(!$like){
        $new_like=new like;
        $new_like->post_id=$post_id;
        $new_like->user_id=$user_idd;
        $new_like->like=0;
        $new_like->save();
       } 
       elseif($like->like==0) {
           DB::table('likes')
           ->where('post_id',$post_id)
          ->Where('user_id',$user_idd)
         ->delete(); 
         $is_dislike=0;
        } 
        else{ //if($like->like==0)
           DB::table('likes')
           ->where('post_id',$post_id)
          ->Where('user_id',$user_idd)
         ->update(['like'=>0]); 
         $swapped=1;
       }
       $json_result=array('is_dislike' => $is_dislike,'swapped'=>$swapped);
       return response()->json($json_result,200);
  }

public function manage_comments(Request $request,$sett_id){
   DB::table('settings')
           ->where('id',$sett_id)
         ->update(['value'=>$request->manage_comment]); 
  return back();
}
public function new_setting(Request $request){
   $setting=DB::table('settings')->where('name',$request->sett_name)->first();
    if(!$setting){
        $new_setting=new setting;
        $new_setting->name=htmlentities($request->sett_name);
        $new_setting->value=$request->sett_value;
        $new_setting->description=htmlentities($request->sett_desc);
        $new_setting->post_id=0;
        $new_setting->user_id=auth::user()->id;
        $new_setting->is_admin=1;
        $new_setting->save();
      }
  return back();
}
///////////////////////////////////////////////////////
public function delete_setting($sett_id){
  DB::table('settings')->where('id',$sett_id)->delete();
  return back();
}

public function delete__custom_settings(){
  DB::table('settings')->where('id',$sett_id)->delete();
  return back();
}

///////////////////////////////////////////////////////

public function stop_comment_post($p_u_ids){
 $separate_ids=$this::separate_ids($p_u_ids);
 $post_id=$separate_ids['post_id'];
 $user_id=$separate_ids['user_id'];
 //dd($separate_ids);
 $sett_name="stop_comment_".$post_id;
 $setting=DB::table('settings')->where('post_id',$post_id)->first();
    if(!$setting){
        $new_setting=new setting;
        $new_setting->name=$sett_name;
        $new_setting->value=0;
        $new_setting->description='set by post owner';
        $new_setting->post_id=$post_id;
        $new_setting->user_id=$user_id;
        $new_setting->is_admin=0;
        $new_setting->save();
      }
      else{
        DB::table('settings')->where('post_id',$post_id)->update(['value'=>(1-$setting->value)]);
      }
   return back();
 }

public function separate_ids($ids){
  $post_id='';
 $user_id='';
 $ch1=1;
 for($i=0;$i<strlen($ids);$i++)
    { 
        if($ids[$i]!='_')
        {
            if($ch1==1)
             {
               $post_id.=$ids[$i];
            }
            else{
                 $user_id.=$ids[$i];
            }
        }
        else
        {
            $ch1=0;
        }
    }
    return array('post_id'=>$post_id,'user_id'=>$user_id);
}

 function delete_post($post_id){
 DB::table('posts')->where('id',$post_id)->delete();
 DB::table('comments')->where('post_id',$post_id)->delete();
 DB::table('settings')->where('post_id',$post_id)->delete();

 return back();
}

 function delete_comment($comment_id){
 $post_id=DB::table('comments')->where('id',$comment_id)->value('post_id'); 
 DB::table('comments')->where('id',$comment_id)->delete();
 return redirect('/posts/readmore/'.$post_id);
}

function edit_post($post_id){
   $poster_id=DB::table('posts')->where('id',$post_id)->value('user_id');
  if($poster_id!=auth::user()->id){
    return redirect('/accessDenied');
  }
  else{
    $post=DB::table('posts')->where('id',$post_id)->first();
     $categories=category::all();
    $allow_share=$this::allow_share(); 
    return view('content.update_post',compact('post','categories','allow_share'));
  }
 }

function save_post_edition(request $request,$post_id){
   $poster_id=DB::table('posts')->where('id',$post_id)->value('user_id');
  if($poster_id!=auth::user()->id){
    return redirect('/accessDenied');
  }
  else{ 
    $this->Validate(Request(),[
            'title' => 'required|max:25|min:6',
            'body' => 'required|max:280',
            'category_id' => 'required',
        ]);
        $image_name=DB::table('posts')->where('id',$post_id)->value('url');
        //dd($request->url);
        $ch_photo=$request->stay_post_photo;
        if($request->url&&$image_name==''){
          $this->Validate(Request(),[
            'url' => ' image|mimes:jpg,jpeg,png,gif|max:2048',
             ]);
             $image_name=time().'.'.$request->url->getClientOriginalExtension();
          }
          elseif($ch_photo==0){
             $image_name='';
          }

          DB::table('posts')->where('id',$post_id)
          ->update([
            'title'=>$request->title,
            'body'=>htmlentities($request->body),
            'url'=>$image_name,
            'category_id'=>$request->category_id,
          ]);

        if($request->url){
            $request->url->move(public_path('upload'),$image_name);
        }
      return redirect('/posts/readmore/'.$post_id);
  }
}



function profile($user_id)
    {
      $categories=DB::table('categories')->get();
      $user=DB::table('users')->where('id',$user_id)->first();
      if($user){
      $posts_arr=$this::user_posts($user->id);

        return view('newprofile',compact('user','posts_arr','categories'));
      }
      else{
          return back()->withErrors([
      'message'=>'Sorry , This User doesn\'t match !! ']);
      }
    }


///////////////////////////////////////////
     function user_posts($user_id){
      $posts=post::all()->where('user_id',$user_id);
      $categories=DB::table('categories')->get();
      $users_data=DB::table('users')->get();
      $user_allow_comments=$this::allow_some_posts_comment();
      $users_id_name=array();
      $users_id_prof=array();
      foreach ($users_data as $user) {
        $users_id_name["$user->id"]=$user->name;
        $users_id_prof["$user->id"]=$user->profile;
      }
      //dd($users_id_name);
      $allow_comment=$this::allow_comment(); 
      $allow_share=$this::allow_share(); 

      $arr=array('posts'=>$posts,'allow_share'=>$allow_share,
        'allow_comment'=>$allow_comment,'users_id_name'=>$users_id_name,
        'user_allow_comments'=>$user_allow_comments,'users_id_prof'=>$users_id_prof,
        'categories'=>$categories);
      return $arr;
    }
    ////////////////////////////////////////////

function test(){
  $max_id = DB::table('categories')->latest()->value('id'); 
return view('content.test');
}



///////////////////////  End Class
}
