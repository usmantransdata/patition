<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetitionCategory extends Model
{
    protected $table = 'petition_categories';

    public $timestamps = false;

    
    protected $fillable = ['petition_id', 'categories_id'];
}
