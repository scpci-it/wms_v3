<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location_SpareParts extends Model
{
    protected $table = 'location_spare_parts';

    public function spare_parts()
    {
    	return $this->belongsTo('App\SpareParts');
    }

    public function location()
    {
    	return $this->belongsTo('App\Location');
    }
}
