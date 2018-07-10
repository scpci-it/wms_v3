<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   
     public function __construct()
    {
        $this->middleware('auth');
    }
     
      public function index()
    {
        $categories = Category::all();
        return view('category.index',compact('categories'));
    }

    
    public function create()
    {
        return view('category.create');
    }

    
    public function store(Request $request)
    {
        Category::create($request->all());

        return redirect('/categories');
    }
    
    public function show(Category $category)
    {
        //
    }
    
    public function edit(Category $category)
    {
        //
    }

    
    public function update(Request $request, Category $category)
    {
        //
    }

   
    public function destroy(Category $category)
    {
        //
    }
}
