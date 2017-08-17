<?php

namespace App\Http\Controllers;
use App\Models\BlogPost;
use App\Models\Schedules;
use App\Models\OAP;
use App\Models\Podcast;
use App\Models\Charts;
use App\Models\Category;
use App\Models\Forumcategory;
use App\Models\Forum;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Mail\ContactMail;
use Mail;


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
        $allcate = Category::all();
        $trending = [];
        foreach($allcate as $cat){
            $post = BlogPost::where('category', $cat->id)->where('published', 1)->orderBy('created_at', 'DESC')->with('category')->first();
            if($post != null){
                array_push($trending, $post);
            }
            
        }
        $newones = BlogPost::where('category', 'cd7a5600-5734-11e7-9c98-2f5901ffbcf1')->where('published', 1)->orderBy('created_at', 'DESC')->take(6)->get();
        
         $newones2 = BlogPost::where('promoted', 1)->where('published', 1)->orderBy('created_at', 'DESC')->take(6)->get();
         if(!$newones->isEmpty()){
            if(!$newones2->isEmpty()){

                $newones = array_merge($newones2->toArray(), $newones->toArray());
                $newones = array_slice($newones,0,6);
                //$newones->push($newones2);
                //$newones->sortBy('created_at');
                //$newones->splice(0, 5);
            }  
            //$newones = array_splice($newones, 5);
         }else{
            $newones = $newones2->toArray();
         }
         

        $fresh = BlogPost::with('category')->where('published', 1)->orderBy('created_at', 'desc')->take(10)->get();
        $categories = Category::all();
        $ads = \Adumskis\LaravelAdvert\Model\Advert::with('advert_category')->get();
        return view('landing', compact('trending', 'newones', 'fresh', 'categories', 'ads'));
    }

    /**
    * return the details of a post along with the category and user details
    * @return Object 
    */
    public function post($id){
        $post = BlogPost::where('id', $id)->first();
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
        $trending = BlogPost::where('category', $id)->where('view_count', '>', 1000)->where('view_count', '>', 5000)->orderBy('view_count', 'DESC')->where('published', 1)->orderBy('created_at', 'DESC')->with('category')->get();
        $newones = BlogPost::where('category', $id)->where('view_count', '>', 1000)->where('view_count', '<', 5000)->orderBy('view_count', 'DESC')->where('published', 1)->orderBy('created_at', 'DESC')->with('category')->get();
        $fresh = BlogPost::orderBy('created_at', 'DESC')->where('category', $id)->where('published', 1)->with('category')->get();
        return array('trending'=>$trending,
                     'latest'=>$newones,
                     'fresh'=>$fresh);
    }

    public function forum_category(){
        return Forumcategory::all();
    }

    public function forum_create(Request $request){
        $content = $request->get('content');
        $category = $request->get('category'); 
        $test = new Forum();
        $test->topic = $content;
        $test->description = $content;
        $test->category = $category;
        $test->user_id = auth()->user()->id;
        $test->save(); 
        return $test;
    }

    public function mobile(){
        $trending = BlogPost::where('view_count', '>', 1000)->where('view_count', '>', 5000)->where('published', 1)->orderBy('view_count', 'DESC')->with('category')->take(6)->get();
        $newones = BlogPost::where('view_count', '>', 1000)->where('view_count', '<', 5000)->where('published', 1)->orderBy('view_count', 'DESC')->with('category')->take(3)->get();
        $fresh = BlogPost::with('category')->where('published', 1)->orderBy('created_at', 'desc')->get();
        $categories = Category::all();
        $ads = \Adumskis\LaravelAdvert\Model\Advert::with('advert_category')->get();
        return view('mobileview.index', compact('trending', 'newones', 'fresh', 'categories', 'ads'));
   
    }

    public function app_sess(){
        $trending = BlogPost::where('view_count', '>', 1000)->where('view_count', '>', 5000)->where('published', 1)->orderBy('view_count', 'DESC')->with('category')->take(6)->get();
        $newones = BlogPost::where('view_count', '>', 1000)->where('view_count', '<', 5000)->where('published', 1)->orderBy('view_count', 'DESC')->with('category')->take(6)->get();
        $fresh = BlogPost::with('category')->where('published', 1)->orderBy('created_at', 'DESC')->get();
        $categories = Category::all();
        $ads = \Adumskis\LaravelAdvert\Model\Advert::with('advert_category')->get();
        return json_encode([
                    'trending' => $trending,
                    'newones'=>$newones, 
                    'fresh'=>$fresh,
                    'categories'=>$categories,
                    'ads'=>$ads
                ]);
    }

    public function sendMail(Request $request){
        $name = $request->get('name');
        $body = $request->get('body');
        $email = $request->get('email');
        $phone = $request->get('phone');
        $content = [
    		'title'=> 'New mail from '.$name, 
    		'body'=> $body,
            'email'=>$email,
            'phone'=>$phone
    		];
        $receiverAddress = $request->get('dept');
        $sentmail = Mail::to($receiverAddress)->send(new ContactMail($content));
        return $content;
    }

    public function fbcomment(Request $request, $id){
        $contents = View('comment', compact('id'));
        return response($contents)->header('X-Frame-Options', "*");

        //return $contents;
    }
    
}
