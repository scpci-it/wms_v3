<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpareParts extends Model
{
   protected $fillable = ['name', 'code', 'description'];

    public function locations()
    {

    	return $this->belongsToMany('App\Location', 'location_spare_parts', 'spare_parts_id', 'location_id')
    				->withPivot('stocks');

    }

}
