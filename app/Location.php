<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
  protected $fillable = ['name', 'type', 'wh_id'];

   	public function warehouse()
    {

    	return $this->belongsTo('\App\Warehouse','wh_id','id');

    }

    public function products()
    {

    	return $this->belongsToMany('App\Location', 'location_product', 'location_id', 'product_id');

    }

    public function materials()
    {

    	return $this->belongsToMany('App\Location', 'location_material', 'location_id', 'material_id');

    }

     public function spare_parts()
    {

        return $this->belongsToMany('App\Location', 'location_spare_parts', 'location_id', 'spare_parts_id');

    }
     public function transactions()
    {
        return $this->hasMany('\App\ProductTransaction');
    }
}
