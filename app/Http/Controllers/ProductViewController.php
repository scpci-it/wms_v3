<?php

namespace App\Http\Controllers;

use App\ProductTransaction;
use App\Products;
use App\Location_Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductViewController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $products = Products::all();
        
        $result = [];

        foreach($products as $x):
            
            $current = Location_Product::where('product_id', $x->id)
                       ->oldest('exp_date')->first();

            if($current)
                $result[$x->id] = $current->exp_date;
            else
                $result[$x->id] = "N/A";

        endforeach;

    	return view('product_dashboard.index',compact('products', 'result'));
    }                      

    public function show($id)
    {
      
        $products = Products::find($id);

        $stocks = DB::table('location_product')
        ->select('*')
        ->addSelect('locations.name as location_name')
        ->addSelect('warehouses.name as warehouse_name')
        ->where('product_id', $id)
        ->join('locations', 'locations.id', '=', 'location_product.location_id')
        ->join('warehouses', 'warehouses.id', '=', 'locations.wh_id')
        ->get();
         

        $transactions = ProductTransaction::where('product_id', $id)->latest()->paginate(10);
      
        return view('product_dashboard.show',compact('products','transactions', 'stocks'));
    }
}