<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');



Route::get('/home', 'HomeController@index');
Route::get('/posts/{id}', 'HomeController@post');
Route::get('/schedules', 'HomeController@schedules');
Route::get('/oaps', 'HomeController@oaps');
Route::get('/thisoap/{id}', 'HomeController@thisoap');
Route::get('/allpodcasts', 'HomeController@allpodcasts');
Route::get('/podcast/{week}', 'HomeController@weekpodcast');
Route::get('blog_category/{id}', 'HomeController@blog_category');




Route::get('/charts', 'HomeController@charts');
Route::get('post/{id}/comments', function($id){
      return \App\Models\BlogPost::findOrFail($id)->comments;
    });

    Route::post('post/{id}/comment',function($id, Request $request){
      $user = auth()->user();

      return \App\Models\BlogPost::findOrFail($id)->comment([
          'body' => $request->get('body'),
         'parent_id' => $request->get('parent_id', null)
      ],$user);
    });


    Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
    Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

    Route::get('getforums', function(){
      return \App\Models\Forum::with('category_name', 'user', 'comments')->get();
    });

    Route::get('thisforum/{id}', function($id){
      return \App\Models\Forum::find($id)->with('category_name', 'user', 'comments')->first();
    });

    Route::get('myforum/{id}/comments', function($id){
      return \App\Models\Forum::findOrFail($id)->comments;
    });

    Route::post('myforum/{id}/comment',function($id, Request $request){
      $user = auth()->user();

      return \App\Models\Forum::findOrFail($id)->comment([
          'body' => $request->get('body'),
         'parent_id' => $request->get('parent_id', null)
      ],$user);
    });

    Route::get('hotforum', function(){
      return  \App\Models\Forum::where( DB::raw('YEAR(created_at)'), '=', date('Y'))->with('comments')->get();
      
    });

    Route::get('all_users', function(){
       return  \App\User::all();
    });

    Route::get('shows', function(){
        return \App\Models\Shows::with('user')->orderBy('created_at', "DESC")->get();
    });

    Route::get('related/{id}', function($id){
      return \App\Models\BlogPost::whereHas('category', function ($query) {
              $query->where('id', $id);
          })->take(5)->get();
    });
    
    

Route::group(['namespace' => 'Admin', 'prefix'=>'admin'], function () {
    // Controllers Within The "App\Http\Controllers\Admin" Namespace
    Route::get('login', 'Auth\LoginController@Login');
    Route::get('logout', 'Auth\LoginController@Logout');
    Route::get('register', 'Auth\LoginController@Register');
    CRUD::resource('category', 'CategoryCrudController');
    CRUD::resource('blogpost', 'BlogPostCrudController');
    CRUD::resource('keypoint', 'KeypointCrudController');
    CRUD::resource('schedules', 'SchedulesCrudController');
    CRUD::resource('keypoint', 'KeypointCrudController');
    CRUD::resource('oap', 'OAPCrudController');
    CRUD::resource('podcast', 'PodcastCrudController');
    CRUD::resource('music', 'MusicCrudController');
    CRUD::resource('charts', 'ChartsCrudController');
    CRUD::resource('forumcategory', 'ForumcategoryCrudController');
    CRUD::resource('forum', 'ForumCrudController');
    CRUD::resource('shows', 'ShowsCrudController');
});

 Route::any('{all}', 'HomeController@index')
 ->where(['all' => '.*']);

//Auth::routes();


