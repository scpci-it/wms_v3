<?php

namespace App\Http\Controllers;

use App\Location;
use App\SpareParts;
use App\SparePartsTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SparePartsTransactionController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function index()
    {

        $movements  = SparePartsTransaction::with('user')->latest()->paginate(5);

        return view('spare_parts_transaction.index',compact('movements'));
    }

    public function create()
    {

        $locations = Location::all();
        $spare_parts = SpareParts::all();

        return view('spare_parts_transaction.create',compact('locations','spare_parts'));
    }

    public function internal()
    {

        $to_locations = Location::where('type','=','Physical')->get();
        $from_locations = Location::where('type','=','Physical')->get();
        $spare_parts = SpareParts::all();

        
        return view('spare_parts_transaction.transfer',compact('to_locations','spare_parts', 'from_locations'));
    }

    public function issue_in()
    {

        $to_locations = Location::where('type','=','Physical')->get();
        $from_locations = Location::where('type','=','Virtual')->get();
        $spare_parts = SpareParts::all();

        return view('spare_parts_transaction.transfer',compact('to_locations','spare_parts', 'from_locations'));
    }

    public function issue_out()
    {

        $to_locations = Location::where('type','=','Virtual')->get();
        $from_locations = Location::where('type','=','Physical')->get();
        $spare_parts = SpareParts::all();

        return view('spare_parts_transaction.transfer',compact('to_locations','spare_parts', 'from_locations'));
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();

        $request->validate([
            'quantity' => 'integer|required',
        ]);

        
        SparePartsTransaction::create([
                            'to'=>$request->to,
                            'from'=>$request->from,
                            'spare_parts_id'=>$request->spare_parts_id,
                            'quantity'=>$request->quantity,
                            'user_id'=> $user_id,

                            ]);

        
        SparePartsTransaction::createLocationSparePartsEntry($request->spare_parts_id, $request->from, $request->to);
        SparePartsTransaction::adjustInventory($request->spare_parts_id, $request->from, $request->to, $request->quantity);

        return redirect('/spare_parts_transactions');
    }

}
