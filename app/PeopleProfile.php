<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeopleProfile extends Model
{
 

 protected $table = 'peoples_profile';

 public $timestamps = false;

  protected $fillable = [
        'nick_name', 'avatar','we_site', 'company', 'phone', 'city', 'country', 'dob', 'education', 'occupation', 'interest', 'user_id', 'created_at'
    ];


public function user(){

         return $this->hasMany('App\User');

    }   


    public function petition(){

         return $this->hasMany('App\Petition');

    }   
    
    
}

