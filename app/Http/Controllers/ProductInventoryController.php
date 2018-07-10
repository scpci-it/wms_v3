<?php

namespace App\Http\Controllers;

use App\Location;
use App\Location_Product;
use App\ProductTransaction;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductInventoryController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }


    public function create($id)
    {
        
        $locations = Location_Product::select('stocks')
                                        ->addSelect('locations.id as location_id')
                                        ->addSelect('locations.name as location_name')
                                        ->addSelect('warehouses.name as warehouse_name')
                                        ->where('product_id','=',$id)
                                        ->where('type', '=', 'Physical')
                                        ->join('locations', 'location_id','=', 'locations.id')
                                        ->join('warehouses','wh_id','=','warehouses.id')
                                        ->get();

        $product = Products::find($id);

        return view('product_inventory.create',compact('product','locations'));
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();
        $locations = Location::where('Type','=','Physical')->get();


        foreach($locations as $location):

            $adjusted_quantity = ABS($request->current[$location->id] - $request->actual[$location->id]);
            ProductTransaction::createLocationProductEntry($request->product_id, $location->id, 1);
           
           
            if($request->current[$location->id] > $request->actual[$location->id])
            {
                
                ProductTransaction::create([
                    'from' => $location->id,
                    'to' => 1,
                    'product_id' => $request->product_id,
                    'quantity' => $adjusted_quantity,
                    'exp_date'=>$request->exp_date,
                    'lot_no'=>$request->lot_no,
                    'user_id' =>$user_id
                ]);

                ProductTransaction::adjustInventory($request->product_id, $location->id, 1, $adjusted_quantity,
                                                    $request->exp_date,$request->lot_no);
            }
            
            else if ($request->current[$location->id] < $request->actual[$location->id]) 
            {

                ProductTransaction::create([
                    'from' => 1,
                    'to' => $location->id,
                    'product_id' => $request->product_id,
                    'quantity' => $adjusted_quantity,
                    'exp_date'=>$request->exp_date,
                    'lot_no'=>$request->lot_no,
                    'user_id' => $user_id
                ]);
                ProductTransaction::adjustInventory($request->product_id, 1, $location->id, $adjusted_quantity,
                                                    $request->exp_date,$request->lot_no);   
            }

        endforeach;

        return redirect('/product_transactions');

    }
}

