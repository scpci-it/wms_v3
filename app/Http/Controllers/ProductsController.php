<?php

namespace App\Http\Controllers;

use App\Location;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{

      public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $products = Products::all();
        return view ('product.index', compact ('products'));
    }

    
    public function create()
    {
        $products = Products::all();
        return view ('product.create', compact ('products'));
    }

    
    public function store(Request $request)
    {
         Products::create($request->all());

        return redirect('/products');
    }

    
    public function show(Products $products)
    {
        //
    }

    
    public function edit(Products $products)
    {
        //
    }

    
    public function update(Request $request, Products $products)
    {
        //
    }

    
    public function destroy(Products $products)
    {
        //
    }
}
