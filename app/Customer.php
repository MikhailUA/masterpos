<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{    

    public $timestamps = false;
    
    protected $dates = ['created_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname',
    ];
}
