<?php

namespace App\Http\Controllers;


use App\Material;
use App\MaterialTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MaterialViewController extends Controller
{
 public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function index()
    {   

        $materials = Material::all();

    	return view('material_dashboard.index',compact('materials'));
    }

    public function show($id)
    {

        $material = Material::find($id);

         $transactions = MaterialTransaction::all();

    	return view('material_dashboard.show',compact('material','transactions'));
    }
}
