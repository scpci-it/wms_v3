<?php

namespace App\Http\Controllers;

use App\Location;
use App\Material;
use App\MaterialTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MaterialTransactionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function index()
    {

        $movements  = MaterialTransaction::with('user')->latest()->paginate(5);

        return view('material_transaction.index',compact('movements'));
    }

    public function create()
    {

        $locations = Location::all();
        $materials = Material::all();

        return view('material_transaction.create',compact('locations','materials'));
    }

    public function internal()
    {

        $to_locations = Location::where('type','=','Physical')->get();
        $from_locations = Location::where('type','=','Physical')->get();
        $materials = Material::all();

        
        return view('material_transaction.transfer',compact('to_locations','materials', 'from_locations'));
    }

    public function issue_in()
    {

        $to_locations = Location::where('type','=','Physical')->get();
        $from_locations = Location::where('type','=','Virtual')->get();
        $materials = Material::all();

        return view('material_transaction.transfer',compact('to_locations','materials', 'from_locations'));
    }

    public function issue_out()
    {

        $to_locations = Location::where('type','=','Virtual')->get();
        $from_locations = Location::where('type','=','Physical')->get();
        $materials = Material::all();

        return view('material_transaction.transfer',compact('to_locations','materials', 'from_locations'));
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();

        $request->validate([
            'quantity' => 'integer|required',
        ]);

        
        MaterialTransaction::create([
                            'to'=>$request->to,
                            'from'=>$request->from,
                            'material_id'=>$request->material_id,
                            'quantity'=>$request->quantity,
                            'user_id'=> $user_id,

                            ]);

        
        MaterialTransaction::createLocationMaterialEntry($request->material_id, $request->from, $request->to);
        MaterialTransaction::adjustInventory($request->material_id, $request->from, $request->to, $request->quantity);

        return redirect('/material_transactions');
    }

}
