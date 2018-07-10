<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location_Material extends Model
{
    protected $table = 'location_material';

    public function material()
    {
    	return $this->belongsTo('App\Material');
    }

    public function location()
    {
    	return $this->belongsTo('App\Location');
    }
}
