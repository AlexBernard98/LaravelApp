<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        //$categories = Category::all()->toArray();
        $categories = Category::paginate(2);
        return view('categories.index', compact('categories'));
    }
    

    public function dashboard()
    {
        //$categories = Category::all()->toArray();
        $categories = Category::paginate(10);
        return view('categories.dashboard', compact('categories'));
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
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = $this->validate(request(), [
        'name' => 'required',
	    'description' => 'required'
        ]);
        
        Category::create($category);
        return back()->with('success', 'Category has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
	    return view('categories.edit',compact('category','id'));
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
        $category = Category::find($id);
        $this->validate(request(), [
        'name' => 'required',
	    'description' => 'required'
        ]);
        
        $category->name = $request->get('name');
	    $category->description = $request->get('description');
        $category->save();
        return redirect('categories')->with('success','Category has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('categories')->with('success','Category has been  deleted');
    }
}