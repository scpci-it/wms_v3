<?php

namespace App\Http\Controllers;

use App\Location;
use App\Location_Product;
use App\Products;
use App\ProductTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductTransactionController extends Controller
{
    

     public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        $movements  = ProductTransaction::with('user')->latest()->paginate(5); 
        return view('product_transaction.index',compact('movements'));

    }

    

    public function create()
    {
        $locations = Location::all();
        $products = Products::all();
        

        return view('product_transaction.create',compact('locations','products'));
    }

    public function internal()
    {

        $to_locations = Location::where('type','=','Physical')->get();
        $from_locations = Location::where('type','=','Physical')->get();
        $products = Products::all();

        return view('product_transaction.transfer',compact('to_locations','products', 'from_locations'));
    }

    public function issue_in()
    {

        $to_locations = Location::where('type','=','Physical')->get();
        $from_locations = Location::where('type','=','Virtual')->get();
        $products = Products::all();
        

        return view('product_transaction.issue_in',compact('to_locations','products', 'from_locations'));
    }

    public function issue_out()
    {

        $to_locations = Location::where('type','=','Virtual')->get();
        $from_locations = Location::where('type','=','Physical')->get();
        $products = Products::all();

        return view('product_transaction.issue_out',compact('to_locations','products', 'from_locations'));
    }

    public function issue_out_details(Request $request)
    {


        $product = Products::find($request->product_id);

        $to_location = Location::find($request->to);
        
        $product_transaction = DB::table('product_transactions')
                 ->addSelect('to')
                 ->where('product_id','=',$request->product_id)
                 ->get()->toArray();
        


        $locations = Location_Product::select('stocks')
                    ->addSelect('location_product.id as current_id')
                    ->addSelect('locations.id as location_id')
                    ->addselect('exp_date')
                    ->addselect('lot_no')
                    ->addSelect('locations.name as location_name')
                    ->addSelect('warehouses.name as warehouse_name')
                    ->where('product_id','=',$request->product_id)
                    ->where('type', '=', 'Physical')
                    ->join('locations', 'location_id','=', 'locations.id')
                    ->join('warehouses','wh_id','=','warehouses.id')
                    ->orderBy('exp_date')
                    ->get();

     
        $stocks = DB::table('location_product')
                ->where('product_id',$request->product_id)
                ->orderBy('exp_date')
                ->get()->toArray();
        


    
        $picked = [];
        $to_pick = $request->quantity;
        $i = 0;

        $array_count = count($stocks);

        foreach($stocks as $x)
        {
            $picked[$x->id]['quantity_to_subtract'] = 0;
        }

        while($to_pick > 0)
        {
            $current_id = $stocks[$i]->id;

            $current_quantity = $stocks[$i]->stocks;


            if($to_pick >= $current_quantity)
            {
                $picked[$current_id]['quantity_to_subtract'] = $current_quantity;
                $to_pick = $to_pick - $current_quantity;
            }

            else
            {
                $picked[$current_id]['quantity_to_subtract'] = $to_pick;
                $to_pick = 0; 
            }

            $i++;

            if($i == $array_count)
                break;
        }

        return view('product_transaction.issue_out_details',compact('picked','locations','product','product_transaction','to_location'));
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();

        $request->validate([
            'quantity' => 'integer|required',
        ]);

        
        ProductTransaction::create([
                            'to'=>$request->to,
                            'from'=>$request->from,
                            'product_id'=>$request->product_id,
                            'quantity'=>$request->quantity,
                            'user_id'=> $user_id,
                            'exp_date'=>$request->exp_date,
                            'lot_no'=>$request->lot_no,
                            ]);

        
        ProductTransaction::createLocationProductEntry($request->product_id, $request->from, $request->to);
        ProductTransaction::adjustInventory($request->product_id, $request->from, $request->to, $request->quantity, $request->exp_date,$request->lot_no);

        return redirect('/product_transactions');
    }


    public function store_issue_in(Request $request)
    {

        $user_id = Auth::id();

        $request->validate([
            'quantity' => 'integer|required',
        ]);

        
        ProductTransaction::create([
                            'to'=>$request->to,
                            'from'=>$request->from,
                            'product_id'=>$request->product_id,
                            'quantity'=>$request->quantity,
                            'exp_date'=>$request->exp_date,
                            'lot_no'=>strtoupper($request->lot_no),
                            'user_id'=> $user_id,

                            ]);

        
       $location_check =  DB::table ('location_product')
                        ->where('location_id',$request->to) 
                        ->where('product_id',$request->product_id)
                        ->where('exp_date', $request->exp_date)
                        ->where('lot_no', $request->lot_no)
                        ->count();


        if($location_check)
        {
            DB::table ('location_product')
                        ->where('location_id',$request->to) 
                        ->where('product_id',$request->product_id)
                        ->where('exp_date', $request->exp_date)
                        ->where('lot_no', $request->lot_no)
                        ->increment('stocks',$request->quantity);
        }

        else
        {
            DB::table('location_product')->insert([
                'product_id' => $request->product_id, 
                'location_id' => $request->to,
                'exp_date'=>$request->exp_date,
                'lot_no'=>strtoupper($request->lot_no),
                'stocks' => $request->quantity,
            ]);

        }


        DB::table('products')
            ->where('id', $request->product_id)
            ->increment('total_stocks',$request->quantity);


        return redirect('/product_transactions');
    }

    public function store_issue_out(Request $request)
    { 
        $user_id = Auth::id();

        $quantity = 0;



        $location_products = DB::table('location_product')
                ->where('product_id',$request->product_id)
                ->get();
        
        foreach($location_products as $x)
        {
            DB::table('location_product')
                ->where('id',$x->id)
                ->decrement('stocks',$request->to_picked[$x->id]);
            

            if($request->to_picked[$x->id] != 0)
            {

                $quantity += $request->to_picked[$x->id];

                ProductTransaction::create([
                    'to'=>$request->to,//hidden 
                    'from'=>$x->location_id,//find current
                    'product_id'=>$request->product_id,//hidden
                    'quantity'=>$request->to_picked[$x->id],
                    'exp_date'=>$x->exp_date, //find current
                    'lot_no'=>$x->lot_no,//find current
                    'user_id'=> $user_id,
                    ]);
            } 
        }

            DB::table('location_product')
                    ->where('stocks', '=', 0)
                    ->delete();

            DB::table('products')
                    ->where('id', $request->product_id)
                    ->decrement ('total_stocks', $quantity);
       

        //Update product total stocks in product table;

        return redirect('/product_transactions');
    }
}
 