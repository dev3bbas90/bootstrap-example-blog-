<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//Route::auth();


///////////////////////////////////////// Roles
// Route::get('/admin', 'pagesController@admin');


Route::get('/', function () {
    return view('index');
           });
Route::get('/home', 'HomeController@index');
Route::get('/statistics', 'WelcomeController@statistics');
Route::get('/about', 'WelcomeController@about');
Route::get('/accessDenied', 'WelcomeController@accessDenied');
/////////////////////////////////////////////// register
Route::get('/register', 'RegisterationController@registerpg');//getpage
Route::post('/new_registeration','RegisterationController@create_user');

//////////////////////////////////////////////login
Route::get('/login', 'SessionController@loginpg');
Route::post('/userlogin', 'SessionController@login');

Route::get('/logout', 'SessionController@logout');

Route::get('/t', 'pagesController@test');

//////////////////////////////////////////////////////////// USer & Admin & manager
Route::group(['middleware'=>'roles','roles'=>['user','admin','manager']],function(){

////////////////////////////////  posts
Route::get('/posts', 'pagesController@posts') ;
Route::get('/posts/readmore/{post}', 'pagesController@onepost');
 Route::get('/make_new_post', 'pagesController@create_post');
 Route::post('/posts/store', 'pagesController@store');

Route::get('/switch_user', 'SessionController@switch_user');

///////////////////////////////////////////////  post comment
Route::post('/posts/{post}/saveComment', 'commentsController@saveComment');
////////////////////  category
Route::get('/category/{name}', 'pagesController@category');
Route::get('/posts/category/{name}', 'pagesController@category_2');
Route::post('/category/search_category', 'pagesController@categorySearch');
Route::post('/like', 'pagesController@like')->name('like');
Route::post('/dislike', 'pagesController@dislike')->name('dislike');
// stop commentfor user
Route::get('/stop_comment_post/{p_u_ids}', 'pagesController@stop_comment_post');
Route::get('/delete_post/{post_id}', 'pagesController@delete_post');
Route::get('/edit post/{post_id}/2020', 'pagesController@edit_post');
Route::post('/save post edititon/{post_id}', 'pagesController@save_post_edition');

Route::get('deletecomment/{comment_id}', 'pagesController@delete_comment');
///////////////////////////////////////////////////////////////// profile
Route::get('/profile/{user_id}', 'pagesController@profile');
Route::get('/update my profile', 'SessionController@update_my_profile');
Route::post('/save update my profile', 'SessionController@save_update_my_profile');
////////////////////////////////////
}); // end user

///////////////////////////////////////////////////////////// Admin

Route::group(['middleware'=>'roles','roles'=>['admin']],function(){
   // Route::get('/control', 'HomeController@control');
   Route::post('/roleupdate/{user}', 'HomeController@updateRole');
   Route::post('/manage_comments/{sett_id}', 'pagesController@manage_comments');
   // Route::post('/new_setting', 'pagesController@new_setting');
   Route::get('/delete_setting/{sett_id}', 'pagesController@delete_setting');
   Route::get('/delete_custom_settings', 'pagesController@delete__custom_settings');
   Route::get('/delete_user/{user_id}', 'SessionController@delete_user');
   Route::get('/update_user/{user_id}', 'SessionController@update_user');
   Route::post('/save_update_user/{user_id}', 'SessionController@save_update_user');
}); // end admin

//////////////////////////////////////////////////////////////// separate role route
// Route::get('/control', [
// 'uses'=>'HomeController@control',
// 'as'=>'control',
// 'middleware'=>'roles',
// 'roles'=>['admin']
// ]);
///////////////////////////////////////////////////////////// Admin & manager

Route::group(['middleware'=>'roles','roles'=>['admin','manager']],function(){
   // Route::get('/control', 'HomeController@control');
   Route::get('/editor', 'pagesController@manager');
Route::get('/control', 'HomeController@control');
Route::post('/new_setting', 'pagesController@new_setting');
}); // end manager

///////////////////////////////////////////////////////////// not user


