<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Sluggable\SlugOptions;
use Spatie\Sluggable\HasSlug;

class Petition extends Model
{
    
     use HasSlug;

    protected $table = 'petition';

    public $timestamps = false;

   protected $fillable = ['user_id', 'title', 'description','message','signature_target', 'decision_maker', 'avatar', 'slug'];



    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }


     public function signPetition(){

        return $this->hasMany('App\SignPetition');
    }

    /*  public function decisionMaker(){

        return $this->belongsTo('App\DecisionMaker');
    }*/

    public function categories(){
          return $this->belongsTo('App\Categories');
    }

    public function result(){

        return $this->belongsTo('App\Result');
    }

     public function user(){

        return $this->belongsTo('App\User');
    }

      public function profile(){

        return $this->belongsTo('App\PeopleProfile');
    }


       public function comments(){

        return $this->hasMany('App\Comments');
    }

      public function survey(){

        return $this->hasMany('App\Survey');
    }  

     public function surveyResult(){

      return $this->hasMany('App\SurveyResult');
    }



}
