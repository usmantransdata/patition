<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class DecisionMaker extends Model
{

	  use Eloquence;
    
    protected $searchableColumns = ['company'];

     protected $table = 'decision_maker';

    public $timestamps = false;

   protected $fillable = ['company', 'created_at'];



     


    /*  public function petition(){

        return $this->hasMany('App\Petition');
    }
*/


}
