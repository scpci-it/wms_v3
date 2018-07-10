<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SparePartsTransaction extends Model
{

	protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('\App\User');
    }

    public function spare_parts()
    {
    	return $this->belongsTo('\App\SpareParts');
    }

    public function fromL()
    {
    	return $this->belongsTo('\App\Location','from','id');
    }

    public function toL()
    {
    	return $this->belongsTo('\App\Location','to','id');
    }



    public static function checkSparePartsLocation($spare_parts_id, $location)
    {
        return DB::table('location_spare_parts')
            ->where('spare_parts_id',$spare_parts_id)
            ->where('location_id',$location)
            ->count();
    }

    public static function createLocationSparePartsEntry($spare_parts_id, $from_id, $to_id)
    {
       if(!static::checkSparePartsLocation($spare_parts_id, $from_id))
            DB::table('location_spare_parts')->insert([
                'spare_parts_id' => $spare_parts_id, 
                'location_id' => $from_id,
                'stocks' => 0,
            ]);

        if(!static::checkSparePartsLocation($spare_parts_id, $to_id))
            DB::table('location_spare_parts')->insert([
                'spare_parts_id' => $spare_parts_id, 
                'location_id' => $to_id,
                'stocks' => 0,
            ]);
    }


    public static function adjustInventory($spare_parts_id, $from_id, $to_id, $quantity)
    {

        $to = Location::Find($to_id);
        $from = Location::find($from_id);

        if($to->type == "Virtual" && $from->type == "Physical")
            DB::table('spare_parts')
            ->where('id',$spare_parts_id)
            ->decrement('total_stocks',$quantity);

        if($to->type == "Physical" && $from->type == "Virtual")
            DB::table('spare_parts')
            ->where('id', $spare_parts_id)
            ->increment('total_stocks',$quantity);

        DB::table('location_spare_parts')
            ->where('spare_parts_id',$spare_parts_id)
            ->where('location_id',$from_id)
            ->decrement('stocks',$quantity);

        DB::table('location_spare_parts')
            ->where('spare_parts_id',$spare_parts_id)
            ->where('location_id',$to_id)
            ->increment('stocks',$quantity);
    }

}
