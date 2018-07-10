<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
   protected $fillable = ['name', 'code', 'description'];

    public function locations()
    {

    	return $this->belongsToMany('App\Location', 'location_material', 'material_id', 'location_id')
    				->withPivot('stocks');

    }

}
