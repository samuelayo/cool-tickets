<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Jenssegers\Agent\Agent;

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
Route::feeds();
Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Route::group(['middleware' => 'mobile'], function () {

    Route::get('/', 'HomeController@index');

});
Route::get('/ads', function () {
//dd(\Adumskis\LaravelAdvert\Model\AdvertCategory::all());
    dd(\Adumskis\LaravelAdvert\Model\Advert::all());
});


// Route::group(['prefix'=>'m'], function () {
//   Route::get('/', 'HomeController@mobile');

// });

Route::post('sendmail', 'HomeController@sendMail');
Route::group(['middleware' => 'cors'], function () {
    Route::get('/app_sess', 'HomeController@app_sess');
    Route::get('/home', 'HomeController@index');
    Route::get('/posts/{id}', 'HomeController@post');
    Route::get('/schedules', 'HomeController@schedules');
    Route::get('/oaps', 'HomeController@oaps');
    Route::get('/thisoap/{id}', 'HomeController@thisoap');
    Route::get('/allpodcasts', 'HomeController@allpodcasts');
    Route::get('/podcast/{week}', 'HomeController@weekpodcast');
    Route::get('blog_category/{id}', 'HomeController@blog_category');
    Route::get('apiauth/{provider}', 'Auth\LoginController@apiredirectToProvider');
    Route::get('apiauth/{provider}/callback', 'Auth\LoginController@apihandleProviderCallback');
    Route::post('forum_create', 'HomeController@forum_create');

    Route::get('/fbcomment/{id}', 'HomeController@fbcomment');

    Route::get('/charts', 'HomeController@charts');
    Route::get('post/{id}/comments', function ($id) {
        return \App\Models\BlogPost::where('id', $id)->first()->comments;
    });

    Route::post('post/{id}/comment', function (\App\Models\BlogPost $id, Request $request) {

        $user = auth()->user() ? auth()->user() : \App\User::find($request->get('user_id'));
        $id->comment([
            'body' => $request->get('body'),
            'parent_id' => $request->get('parent_id', null)
        ], $user);
        $all_comments = $id->comments;
        $data = array('event' => 'CommentMade',
            'data' => [
                'type' => 'blog',
                'id' => $id,
                'all_comments' => $all_comments
            ]);
        //Redis::publish('coolfm-lagos',json_encode($data));
        return $data;
    });

    //forum categories.
    Route::get('/forum_category', 'HomeController@forum_category');


    Route::get('getforums', function () {
        return \App\Models\Forum::with('category_name', 'user', 'comments')->get();
    });

    Route::get('thisforum/{id}', function ($id) {
        return \App\Models\Forum::where('id', $id)->with('category_name', 'user', 'comments')->first();
    });

    Route::get('myforum/{id}/comments', function ($id) {
        return \App\Models\Forum::where('id', $id)->first()->comments;
    });

    Route::post('myforum/{id}/comment', function ($id, Request $request) {

        $user = auth()->user() ? auth()->user() : \App\User::find($request->get('user_id'));
        \App\Models\Forum::where('id', $id)->first()->comment([
            'body' => $request->get('body'),
            'parent_id' => $request->get('parent_id', null)
        ], $user);
        $all_comments = \App\Models\Forum::where('id', $id)->first()->comments;
        $data = array('event' => 'CommentMade',
            'data' => [
                'type' => 'forum',
                'id' => $id,
                'all_comments' => $all_comments
            ]);
        //Redis::publish('coolfm-lagos',json_encode($data));
        return $data;
    });

    Route::get('hotforum', function () {
        return \App\Models\Forum::where(DB::raw('YEAR(created_at)'), '=', date('Y'))->with('comments')->get();

    });

    Route::get('all_users', function () {
        return \App\User::all();
    });

    Route::get('shows', function () {
        return \App\Models\Shows::with('user')->orderBy('created_at', "DESC")->get();
    });

    Route::get('related/{id}', function ($id) {
        return \App\Models\BlogPost::whereHas('category', function ($query) use ($id) {
            $query->where('id', $id);
        })->orderBy('created_at', "DESC")->take(5)->get();
    });
    Route::post('initiate_ticket_purchase', 'Admin\EventsController@initiate');

    Route::post('ticket_purchased', 'Admin\EventsController@ticket_purchased');


    Route::get('all_tickets', 'Admin\EventsController@allticktes');
    Route::get('categories', 'Admin\EventsController@getCategories');
    Route::get('get_slides', 'Admin\EventsController@getSlides');
    Route::get('events/{name}', 'Admin\EventsController@event');
    Route::get('/vendor/register', function (){
       return view('vendor');
    });
    Route::post('/vendor/register', 'Admin\VendorCrudController@register');
    Route::get('events/details/{name}', 'Admin\EventsController@getEvent');
    Route::get('ticket/{id}/redeem', 'Admin\EventsController@redeem');
});
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'isadmin']], function () {
    // Controllers Within The "App\Http\Controllers\Admin" Namespace
    Route::get('/', function () {
        redirect('/admin/blogpost')->route();
    });

    Route::any('elfinder/connector', '\Barryvdh\Elfinder\ElfinderController@showConnector');
    Route::get('elfinder/popup/{input_id}', '\Barryvdh\Elfinder\ElfinderController@showPopup');
    Route::get('elfinder/tinymce', '\Barryvdh\Elfinder\ElfinderController@showTinyMCE');
    Route::get('elfinder/tinymce4', '\Barryvdh\Elfinder\ElfinderController@showTinyMCE4');
    Route::get('elfinder/ckeditor', '\Barryvdh\Elfinder\ElfinderController@showCKeditor4');
    CRUD::resource('elfinder', '\Barryvdh\Elfinder\ElfinderController');

    Route::get('dashboard', function () {
        redirect('/admin/blogpost');
    });
    Route::get('logout', 'Auth\LoginController@Logout');
    Auth::routes();
    Route::get('logout', 'Auth\LoginController@Logout');
    CRUD::resource('user', 'UserCrudController');
    CRUD::resource('carousel', 'CarouselCrudController');
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
    CRUD::resource('eventscategory', 'EventscategoryCrudController');
    CRUD::resource('vendor', 'VendorCrudController');
    Route::get('events', 'EventsController@list');
    Route::get('events/create', 'EventsController@create');
    Route::post('events/create', 'EventsController@createpost');
    Route::get('events/{id}/delete', 'EventsController@delete_event');
    Route::get('events/{id}/tlist', 'EventsController@tlist');
    CRUD::resource('adscategory', 'AdsCategoryCrudController');
    Route::get('ads', 'AdsEngineController@list');
    Route::get('adslist', 'AdsEngineController@adslist');
    Route::get('adslist/{id}/edit', 'AdsEngineController@adsedit');
    Route::get('adslist/{id}/delete', 'AdsEngineController@adsdelete');
    Route::post('adslist/{id}/edit', 'AdsEngineController@adseditpost');
    Route::post('ads', 'AdsEngineController@createad');
});


Route::any('{all}',
    function (Request $request, $all) {
        $agent = new Agent();
        // if($agent->isMobile()){
        //      $url = '/m#/'.$request->path();

        //      return redirect($url);
        // }
        return (new App\Http\Controllers\HomeController)->index();
        // Stuffffffff


    }
)
    ->where(['all' => '.*']);

//Auth::routes();


