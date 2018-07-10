<?php

namespace App\Http\Controllers;

use App\Location;
use App\Location_SpareParts;
use App\SpareParts;
use App\SparePartsTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SparePartsInventoryController extends Controller
{
    
      public function __construct()
    {
        $this->middleware('auth');
    }

    public function create($id)
    {
        
        $locations = Location_SpareParts::select('stocks')
                                        ->addSelect('locations.id as location_id')
                                        ->addSelect('locations.name as location_name')
                                        ->addSelect('warehouses.name as warehouse_name')
                                        ->where('spare_parts_id','=',$id)
                                        ->where('type', '=', 'Physical')
                                        ->join('locations', 'location_id','=', 'locations.id')
                                        ->join('warehouses','wh_id','=','warehouses.id')
                                        ->get();

        $spare_parts = SpareParts::find($id);

        return view('spare_parts_inventory.create',compact('spare_parts','locations'));
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();
        $locations = Location::where('Type','=','Physical')->get();


        foreach($locations as $location):

            $adjusted_quantity = ABS($request->current[$location->id] - $request->actual[$location->id]);
            SparePartsTransaction::createLocationSparePartsEntry($request->spare_parts_id, $location->id, 1);
           
            if($request->current[$location->id] > $request->actual[$location->id])
            {
                
                SparePartsTransaction::create([
                    'from' => $location->id,
                    'to' => 1,
                    'spare_parts_id' => $request->spare_parts_id,
                    'quantity' => $adjusted_quantity,
                    'user_id' =>$user_id
                ]);

                SparePartsTransaction::adjustInventory($request->spare_parts_id, $location->id, 1, $adjusted_quantity);
            }
            
            else if ($request->current[$location->id] < $request->actual[$location->id]) 
            {

               SparePartsTransaction::create([
                    'from' => 1,
                    'to' => $location->id,
                    'spare_parts_id' => $request->spare_parts_id,
                    'quantity' => $adjusted_quantity,
                    'user_id' => $user_id
                ]);
                SparePartsTransaction::adjustInventory($request->spare_parts_id, 1, $location->id, $adjusted_quantity);   
            }

        endforeach;

        return redirect('/spare_parts_transactions');

    }
}
