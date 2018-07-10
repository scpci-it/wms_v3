<?php

namespace App\Http\Controllers;

use App\Location;
use App\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaterialController extends Controller
{
    
      public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $materials = Material::all();
       return view ('material.index', compact ('materials')); 
    }

    
    public function create()
    {
       $materials = Material::all();
       return view ('material.create', compact ('materials'));
    }

    
    public function store(Request $request)
    {
        Material::create($request->all());
        $latest_material_id = Material::latest()->limit(1)->first()->id;

        
        $locations = Location::all();
    

        foreach($locations as $location)
        {

            
            DB::table('location_material')
                    ->insert([
                            'material_id' => $latest_material_id,
                            'location_id' => $location->id,
                            'stocks' => 0,
                    ]);
        }
       

        return redirect('/materials');
    }

    
    public function show(Material $material)
    {
        //
    }

    
    public function edit(Material $material)
    {
        //
    }

    
    public function update(Request $request, Material $material)
    {
        //
    }

    
    public function destroy(Material $material)
    {
        //
    }
}
