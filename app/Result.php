<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
  

  protected $table = 'petition_result';


   public $timestamps = false;

   protected $fillable = ['user_id', 'petition_id', 'option_id', 'created_at'];




 public function petition(){

        return $this->hasMany('App\Petition');
    }

}
