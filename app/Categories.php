<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Categories extends Model
{
   


	  use HasSlug;
   protected $table = 'category';

   public $timestamps = false;

		protected $fillable = ['name', 'description', 'slug', 'post_id', 'created_by'];





public function post(){

	return $this->belongsTo('App/Post');
}




 public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }


    public function petition(){

    return $this->hasMany('App\Petition');
  }


}
