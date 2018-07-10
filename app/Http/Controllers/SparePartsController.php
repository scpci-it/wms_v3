<?php

namespace App\Http\Controllers;

use App\Location;
use App\SpareParts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SparePartsController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $spare_parts = SpareParts::all();
        return view ('spare_parts.index', compact ('spare_parts'));
    }

   
    public function create()
    {
        $spare_parts = SpareParts::all();
        return view ('spare_parts.create', compact ('spare_parts'));
    }

    
    public function store(Request $request)
    {
       SpareParts::create($request->all());
        $latest_spare_parts_id = SpareParts::latest()->limit(1)->first()->id;

        
        $locations = Location::all();
    

        foreach($locations as $location)
        {

            
            DB::table('location_spare_parts')
                    ->insert([
                            'spare_parts_id' => $latest_spare_parts_id,
                            'location_id' => $location->id,
                            'stocks' => 0,
                    ]);
        }
          
        return redirect('/spare_parts');
    }

    
    public function show(SpareParts $spareParts)
    {
        //
    }

    
    public function edit(SpareParts $spareParts)
    {
        //
    }

    
    public function update(Request $request, SpareParts $spareParts)
    {
        //
    }

    
    public function destroy(SpareParts $spareParts)
    {
        //
    }
}
