<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;

class PageContoller extends Controller
{
    public function index(){

        $products = Product::all();
        return view('admin.index' , compact('products'));
    }
    public function create(){
        return view('admin.create');
    }
    public function store(Request $request){
        $validatedData = $request->validate([
           'name' => 'required',
           'price' => 'required',
           'description' => 'required',
            'slug' => 'required',
        ]);

        Product::query()->create([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'description' => $validatedData['description'],
            'slug' => $validatedData['slug'],
        ]);

        return redirect()->route('index')
            ->with('success','Product created successfully');
    }
    public function destroy($id){
        $products = Product::query()->find($id);
        $products->delete();

        return redirect()->route('index')->with('messsage','Product Deleted Successfully');
    }
}
