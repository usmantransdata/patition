<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyResult extends Model
{
    protected $table = 'petition_result';

    public $timestamps = false;

    
     protected $fillable = [ 'user_id', 'petition_id', 'survey_id', 'survey_option'];



  public function petition(){

    	return $this->belongsTo('App\Petition');
    }


    public function survey(){

    	return $this->belongsTo('App\Survey');
    }

}
