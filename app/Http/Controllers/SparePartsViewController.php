<?php

namespace App\Http\Controllers;


use App\SpareParts;
use App\SparePartsTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SparePartsViewController extends Controller
{
 public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function index()
    {   

        $spare_parts = SpareParts::all();

    	return view('spare_parts_dashboard.index',compact('spare_parts'));
    }

    public function show($id)
    {

        $spare_parts = SpareParts::find($id);

         $transactions = SparePartsTransaction::all();


    	return view('spare_parts_dashboard.show',compact('spare_parts','transactions'));
    }
}
