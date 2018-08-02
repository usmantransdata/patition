<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $table = 'petition_survey';

    public $timestamps = false;

    
     protected $fillable = [ 'title', 'question', 'option1', 'option2', 'user_id', 'petition_id' ];


   public function petition(){

    	return $this->belongsTo('App\Petition');
    }

    public function surveyResult(){
		return $this->hasMany('App\SurveyResult');
    }

    
 
 
}
