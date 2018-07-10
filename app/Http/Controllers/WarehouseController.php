<?php

namespace App\Http\Controllers;

use App\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
       public function __construct()
    {
        $this->middleware('auth');
    }

        public function index()
    {
        $warehouses = Warehouse::all();
        return view('warehouse.index',compact('warehouses'));
    }

        public function create()
    {
        return view('warehouse.create');
    }

        public function store(Request $request)
    {

        Warehouse::create($request->all());

        return redirect('/warehouses');
    }
}
