<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\Categories;
use DateTime;

class Post extends Model
{

	  use HasSlug;
      protected $table = 'posts';

     

     public $timestamps = false;

    protected $fillable = ['title', 'body', 'slug', 'author_id', 'post_status', 'categories_id', 'created_by', 'deleted_by', 'visibility'
    ];

        public static function boot()
        {
       
        parent::boot();
         
        static::creating(function($model) {
        $dt = new DateTime;
        $model->created_at = $dt->format('m-d-y H:i:s');
        return true;
        });
         
        static::updating(function($model) {
        $dt = new DateTime;
        $model->updated_at = $dt->format('m-d-y H:i:s');
        return true;
        });
    }

     public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

     public function user_id(){
        return $this->hasOne(Post::class, 'author_id');
    }


     public function users(){

      return $this->hasMany('App\User', 'id', 'author_id');
    }

     public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function comments()
    {
        return $this->hasMany('App\Comments');
    }

     public function categories(){

      return $this->hasMany('App\Categories');
    }

}
