<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location_Product extends Model
{
    protected $table = 'location_product';

    public function product()
    {
    	return $this->belongsTo('App\Products');
    }

    public function location()
    {
    	return $this->belongsTo('App\Location');
    }

    
}
