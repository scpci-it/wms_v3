<?php

namespace App;


use App\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductTransaction extends Model
{

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('\App\User');
    }

    public function product()
    {
        return $this->belongsTo('\App\Products');
    }

    public function fromL()
    {
        return $this->belongsTo('\App\Location','from','id');
    }

    public function toL()
    {
        return $this->belongsTo('\App\Location','to','id');
    }


    public static function checkProductLocation($product_id, $location)
    {
        return DB::table('location_product')
            ->where('product_id',$product_id)
            ->where('location_id',$location)
            ->count();
    }

    public static function createLocationProductEntry($product_id, $from_id, $to_id)
    {
       if(!static::checkProductLocation($product_id, $from_id))
            DB::table('location_product')->insert([
                'product_id' => $product_id, 
                'location_id' => $from_id,
                'stocks' => 0,
            ]);

        if(!static::checkProductLocation($product_id, $to_id))
            DB::table('location_product')->insert([
                'product_id' => $product_id, 
                'location_id' => $to_id,
                'stocks' => 0,
            ]);
    }


    public static function adjustInventory($product_id, $from_id, $to_id, $quantity)
    {

        $to = Location::Find($to_id);
        $from = Location::find($from_id);

        if($to->type == "Virtual" && $from->type == "Physical")
            DB::table('products')
            ->where('id',$product_id)
            ->decrement('total_stocks',$quantity);

        if($to->type == "Physical" && $from->type == "Virtual")
            DB::table('products')
            ->where('id', $product_id)
            ->increment('total_stocks',$quantity);

        DB::table('location_product')
            ->where('product_id',$product_id)
            ->where('location_id',$from_id)
            ->decrement('stocks',$quantity);

        DB::table('location_product')
            ->where('product_id',$product_id)
            ->where('location_id',$to_id)
            ->increment('stocks',$quantity);
    }

}
