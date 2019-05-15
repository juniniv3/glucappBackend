<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registry extends Model
{
  public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'measurement','classification','level','message'
    ];

}
