<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';

    public $timestamps = false;

   protected $fillable = ['comment']; 





 public function post(){

      return $this->belongsTo('App\Post');
    }

 public function user(){

      return $this->belongsTo('App\User');
    }



public function petition(){

      return $this->belongsTo('App\Petition');
    }


}
