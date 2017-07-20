<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use App\Uuids;
use BrianFaust\Commentable\HasComments;
use Spatie\Feed\FeedItem;

class BlogPost extends Model implements FeedItem
{
    use HasComments;
    use CrudTrait;
    use Uuids;
    public $incrementing = false;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
 
    
    //protected $table = 'blog_posts';
    //protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = ['content', 'user_id', 'category', 'image', 'title', 'view_count'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
     public function getFeedItemId()
    {
        return $this->id;
    }

    public function getFeedItemTitle() : string
    {
        return $this->title;
    }

    public function getFeedItemSummary() : string
    {
        return strip_tags($this->content);
    }

    public function getFeedItemUpdated()
    {
        return $this->updated_at;
    }

    public function getFeedItemLink() : string
    {
        //return action('NewsItemController@detail', [$this->url]);
        return '/blogpost/'.$this->id.'/'.str_replace(' ', '_', $this->title);
    }
    
    public function getFeedItemAuthor() : string
    {
        return 'Admin';
    }

    public function getFeedItems()
{
   return \App\Models\BlogPost::all();
}

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
   


    public function category(){
        return $this->belongsTo('App\Models\Category', 'category', 'id');
    }

     public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function keypoints(){
        return $this->hasMany('App\Models\Keypoint', 'id', 'blog_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */
    public function setimageAttribute($value)
    {
        $attribute_name = "image";
        $disk = "uploads";
        $destination_path = "folder_1";

        // if the image was erased
        if ($value==null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->logo);

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (starts_with($value, 'data:image'))
        {
            // 0. Make the image
            $image = \Image::make($value);
            // 1. Generate a filename.
            $filename = md5($value.time()).'.jpg';
            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
            // 3. Save the path to the database
            $this->attributes[$attribute_name] = "/uploads/".$destination_path.'/'.$filename;
        }
    }

    // public function setextra_imagesAttribute($value){
    //     $attribute_name = "extra_images";
    //     $this->attributes[$attribute_name] = json_encode($value);
    // }

    public function setweekAttribute($value)
    {
        $attribute_name = "week"; 
        $date = new \DateTime(new \Date());
        $week = $date->format("W");
        $this->attributes[$attribute_name] = $week;
    }
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
