<?php

namespace App\Http\Controllers;

use App\Location;
use App\Material;
use App\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    
      public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $locations = Location::all();
        return view ('location.index', compact ('locations'));
    }

    
    public function create()
    {
         $warehouses = Warehouse::all();
         return view('location.create', compact ('warehouses'));
    
    }

    
    public function store(Request $request)
    {
         Location::create($request->all());

        return redirect('/locations');
    }

    
    public function show(Location $location)
    {
        //
    }

    public function edit(Location $location)
    {
        //
    }

    
    public function update(Request $request, Location $location)
    {
        //
    }

    
    public function destroy(Location $location)
    {
        //
    }
}
