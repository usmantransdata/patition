<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peoples extends Model
{
   
   protected $table = 'peoples';


   protected $fillable = ['title', 'decision_maker', 'message', 'message', 'slug'];
}
