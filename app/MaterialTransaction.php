<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MaterialTransaction extends Model
{

	protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('\App\User');
    }

    public function material()
    {
    	return $this->belongsTo('\App\Material');
    }

    public function fromL()
    {
    	return $this->belongsTo('\App\Location','from','id');
    }

    public function toL()
    {
    	return $this->belongsTo('\App\Location','to','id');
    }



    public static function checkMaterialLocation($material_id, $location)
    {
        return DB::table('location_material')
            ->where('material_id',$material_id)
            ->where('location_id',$location)
            ->count();
    }

    public static function createLocationMaterialEntry($material_id, $from_id, $to_id)
    {
       if(!static::checkMaterialLocation($material_id, $from_id))
            DB::table('location_material')->insert([
                'material_id' => $material_id, 
                'location_id' => $from_id,
                'stocks' => 0,
            ]);

        if(!static::checkMaterialLocation($material_id, $to_id))
            DB::table('location_material')->insert([
                'material_id' => $material_id, 
                'location_id' => $to_id,
                'stocks' => 0,
            ]);
    }


    public static function adjustInventory($material_id, $from_id, $to_id, $quantity)
    {

        $to = Location::Find($to_id);
        $from = Location::find($from_id);

        if($to->type == "Virtual" && $from->type == "Physical")
            DB::table('materials')
            ->where('id',$material_id)
            ->decrement('total_stocks',$quantity);

        if($to->type == "Physical" && $from->type == "Virtual")
            DB::table('materials')
            ->where('id', $material_id)
            ->increment('total_stocks',$quantity);

        DB::table('location_material')
            ->where('material_id',$material_id)
            ->where('location_id',$from_id)
            ->decrement('stocks',$quantity);

        DB::table('location_material')
            ->where('material_id',$material_id)
            ->where('location_id',$to_id)
            ->increment('stocks',$quantity);
    }

}
