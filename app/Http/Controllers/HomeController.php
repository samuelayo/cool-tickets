<?php

namespace App\Http\Controllers;
use App\Models\BlogPost;
use App\Models\Schedules;
use App\Models\OAP;
use App\Models\Podcast;
use App\Models\Charts;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
   
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trending = BlogPost::where('view_count', '>', 1000)->where('view_count', '>', 5000)->orderBy('view_count', 'DESC')->with('category')->take(6)->get();
        $newones = BlogPost::where('view_count', '>', 1000)->where('view_count', '<', 5000)->orderBy('view_count', 'DESC')->with('category')->take(3)->get();
        $fresh = BlogPost::take(5)->with('category')->get();
        $categories = Category::all();
        $ads = \Adumskis\LaravelAdvert\Model\Advert::with('advert_category')->get();
        return view('landing', compact('trending', 'newones', 'fresh', 'categories', 'ads'));
    }

    /**
    * return the details of a post along with the category and user details
    * @return Object 
    */
    public function post($id){
        $post = BlogPost::find($id);
        $post->view_count +=1;
        $post->save();
        return BlogPost::where('id',$id)->with('category', 'user')->first();
    }


    /**
    * return the details of a post along with the category and user details
    * @return Object 
    */
    public function schedules(){
        return Schedules::all();
    }

    public function oaps(){
        return OAP::all();
    }
    public function thisoap(OAP $id){
        return $id;
    }
    public function allpodcasts(){
       return  Podcast::where( DB::raw('YEAR(created_at)'), '=', date('Y'))->get();
    }
    public function weekpodcast($week){
         return Podcast::where( DB::raw('YEAR(created_at)'), '=', date('Y'))->where('week', $week)->get();
    }
    public function charts(){
        return Charts::where( DB::raw('YEAR(created_at)'), '=', date('Y'))->with('songs')->get();
    }
    public function blog_category($id){
        $trending = BlogPost::where('category', $id)->where('view_count', '>', 1000)->where('view_count', '>', 5000)->orderBy('view_count', 'DESC')->orderBy('created_at', 'DESC')->with('category')->get();
        $newones = BlogPost::where('category', $id)->where('view_count', '>', 1000)->where('view_count', '<', 5000)->orderBy('view_count', 'DESC')->orderBy('created_at', 'DESC')->with('category')->get();
        $fresh = BlogPost::orderBy('created_at', 'DESC')->where('category', $id)->with('category')->get();
        return array('trending'=>$trending,
                     'latest'=>$newones,
                     'fresh'=>$fresh);
    }


    public function mobile(){
        $trending = BlogPost::where('view_count', '>', 1000)->where('view_count', '>', 5000)->orderBy('view_count', 'DESC')->with('category')->take(6)->get();
        $newones = BlogPost::where('view_count', '>', 1000)->where('view_count', '<', 5000)->orderBy('view_count', 'DESC')->with('category')->take(3)->get();
        $fresh = BlogPost::take(5)->with('category')->get();
        $categories = Category::all();
        $ads = \Adumskis\LaravelAdvert\Model\Advert::with('advert_category')->get();
        return view('mobileview.index', compact('trending', 'newones', 'fresh', 'categories', 'ads'));
   
    }
}
