<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Sluggable\SlugOptions;
use Spatie\Sluggable\HasSlug;

class SignPetition extends Model
{
   protected $table = 'sign_petition';


  use HasSlug;
  public $timestamps = false;

    protected $fillable = [ 'user_id', 'answer', 'slug', 'user_name', 'user_email','petition_id', 'created_at' ];


 

  public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('answer')
            ->saveSlugsTo('slug');
    }

     public function petition(){

    	return $this->belongsTo('App\Petition');
    }

}
