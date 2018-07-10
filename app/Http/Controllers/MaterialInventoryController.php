<?php

namespace App\Http\Controllers;

use App\Location;
use App\Location_Material;
use App\Material;
use App\MaterialTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MaterialInventoryController extends Controller
{
    
      public function __construct()
    {
        $this->middleware('auth');
    }

    public function create($id)
    {
        
        $locations = Location_Material::select('stocks')
                                        ->addSelect('locations.id as location_id')
                                        ->addSelect('locations.name as location_name')
                                        ->addSelect('warehouses.name as warehouse_name')
                                        ->where('material_id','=',$id)
                                        ->where('type', '=', 'Physical')
                                        ->join('locations', 'location_id','=', 'locations.id')
                                        ->join('warehouses','wh_id','=','warehouses.id')
                                        ->get();

        $material = Material::find($id);

        return view('material_inventory.create',compact('material','locations'));
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();
        $locations = Location::where('Type','=','Physical')->get();


        foreach($locations as $location):

            $adjusted_quantity = ABS($request->current[$location->id] - $request->actual[$location->id]);
            MaterialTransaction::createLocationMaterialEntry($request->material_id, $location->id, 1);
           
            if($request->current[$location->id] > $request->actual[$location->id])
            {
                
                MaterialTransaction::create([
                    'from' => $location->id,
                    'to' => 1,
                    'material_id' => $request->material_id,
                    'quantity' => $adjusted_quantity,
                    'user_id' =>$user_id
                ]);

                MaterialTransaction::adjustInventory($request->material_id, $location->id, 1, $adjusted_quantity);
            }
            
            else if ($request->current[$location->id] < $request->actual[$location->id]) 
            {

                MaterialTransaction::create([
                    'from' => 1,
                    'to' => $location->id,
                    'material_id' => $request->material_id,
                    'quantity' => $adjusted_quantity,
                    'user_id' => $user_id
                ]);
                MaterialTransaction::adjustInventory($request->material_id, 1, $location->id, $adjusted_quantity);   
            }

        endforeach;

        return redirect('/material_transactions');

    }
}
