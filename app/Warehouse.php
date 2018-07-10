<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
      protected $fillable = ['name','code'];

    public function locations()
    {
    	return $this->hasMany('\App\Location');

    }
}
