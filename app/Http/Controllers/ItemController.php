<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Category;
use Auth;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    // 0) Display 2 items per page.
    // 1) Display the item index view which contains items and categories. 
    /*
    public function index()
    {
        //$items = Item::all();
        $items = Item::paginate(2); //0 
        return view('items.index', compact('items', 'categories')); //1
    }*/

    // 0) Display 10 items per page.
    // 1) Display the dashboard view, and pass it items and categories. 
    public function index()
    {
        //$items = Item::all();
        $items = Item::paginate(10); //0
        return view('items.dashboard', compact('items', 'categories')); //1
    }

    // 0) This code attempts to authorise the user based on the email and password.
    // 1) Checks to see if the email that the user has logged in as matches the one set as the admin account. 
    // 2) If the user is an admin, then redirect them to the item index page.
    // 3) If the user is not logged in an admin, redirect to the user shop page.
    // 4) Redirects the user back to the previous page.
    public function __construct(Request $request)
    {
        //$this->middleware('auth', ['except' => ['index', 'show']]); 

        if(Auth::attempt([ //0
            'email' => $request->email,
            'password' => $request->password
        ]))
        {
            $user = User::where('email', $request->email)->first(); //1
            if($user->is_admin()); //2
            {
                return  redirect()->route('item.index');
            }
            return  redirect()->route('/shop'); //3
        }
        return  redirect()->back(); //4
    } 


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // 0) The orderBy method is called and organises the cateogies by their ID. 
    // 1) The create view is displayed, along with a list of the categories in a drop down box.
    public function create()
    {
        $categories = Category::orderBy('name', 'id')->get(); //0
        return view('items.create')->with('categories', $categories); //1
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // 0) The validate property is called for the details of the item.
    // 1) Validation is applied to the data.
    // 2) The create method is called and the item is created.
    // 3) The user is returned to the dashboard view and a success message is displayed at the top of the page.
    public function store(Request $request)
    {
        $item = $this->validate(request(), [//0
        'name' => 'required',               //1
	    'category' => 'required',
	    'description' => 'required',
        'price' => 'required|numeric',
	    'quantity' => 'required|numeric'
        ]);
        
        Item::create($item); //2
        return back()->with('success', 'Item has been added'); //3
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // 0) The findOrFail method is called, which attempt to find the item details or display an error message if it cannot find them.
    // 1) The show view is displayed with the item details.
    public function show($id)
    {
        $item = Item::findOrFail($id); //0
        return view('items.show')->with('item', $item); //1
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // 0) The find method is called, which looks for the item by its ID.
    // 1) The orderBy method is called and organises the cateogies by their ID. 
    // 2) The edit page is displayed and is updated with the new data. 
    public function edit($id)
    {
        $item = Item::find($id); //0
        $categories = Category::orderBy('name', 'id')->get(); //1
	    return view('items.edit',compact('item','id'))->with('categories', $categories); //2
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // 0) The ID of the item is found.
    // 1) A validation request is sent.
    // 2) Validation is applied to the details that have been entered.
    // 3) The new data is saved to the item. 
    // 4) The new item details are saved.
    // 5) The user is returned to the dashboard and a success message is displayed. 
    public function update(Request $request, $id)
    {
        $item = Item::find($id); //0
        $this->validate(request(), [ //1
        'name' => 'required', //2
	    'category' => 'required',
	    'description' => 'required',
        'price' => 'required|numeric',
	    'quantity' => 'required|numeric'
        ]);
        
        $item->name = $request->get('name'); //3
	    $item->category = $request->get('category');
	    $item->description = $request->get('description');
        $item->price = $request->get('price');
    	$item->quantity = $request->get('quantity');
        $item->save(); //4
        return redirect('items')->with('success','Item has been updated'); //5
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // 0) The item is found via its ID.
    // 1) The item is deleted from the database.
    // 2) The dashboard page is refreshed with a success message at the top of the page. 
    public function destroy($id)
    {
        $item = Item::find($id); //0
        $item->delete(); //1
        return redirect('items')->with('success','Item has been deleted'); //2
    }
}