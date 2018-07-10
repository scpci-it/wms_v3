<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Products extends Model
{
    protected $fillable = ['name', 'code', 'description'];

       public function transactions()
    {
        return $this->hasMany('\App\ProductTransaction');
    }

    public function locations()
    {

        return $this->belongsToMany('App\Location', 'location_product', 'product_id', 'location_id')
                    ->withPivot('stocks');

    }

 
 }

