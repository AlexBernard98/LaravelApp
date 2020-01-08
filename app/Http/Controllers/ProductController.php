<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//ProductController.php
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$products = Product::all()->toArray();
        $products = Product::paginate(2);
        return view('products.index', compact('products'));
    }

    public function dashboard()
    {
        //$products = Product::all()->toArray();
        $products = Product::paginate(2);
        return view('products.dashboard', compact('products'));
    }

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                                $product = $this->validate(request(), [
        'name' => 'required',
                                'price' => 'required|numeric'
                ]);
                
                Product::create($product);
                return back()->with('success', 'Product has been added');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
                                return view('products.edit',compact('product','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $this->validate(request(), [
          'name' => 'required',
          'price' => 'required|numeric'
        ]);
                                
        $product->name = $request->get('name');
        $product->price = $request->get('price');
        $product->save();
        return redirect('products')->with('success','Product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('products')->with('success','Product has been  deleted');
    }
}
