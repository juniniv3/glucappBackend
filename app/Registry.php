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

     protected $table = 'registries';
    protected $fillable = [
        'date', 'measurement','classification','level','message'
    ];

    public function user()
       {
          return $this->belongsTo('App\User','user_id');
       }

}
