<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // 0) Retrieves all of the items stored in the database.
    // 1) Returns the shop view with all the items displayed. 
    public function index()
    {
        $items = Item::all(); //0
        return view('shop')->with('items', $items); //1
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // 0) Attempts to find an item with a specific slug. If the slug is not found, an error is displayed. 
    // 1) Finds a random item and assigns it to the variable $interested. 
    // 2) Returns the item view with a random item displayed underneath. 
    public function show($slug)
    {
        $item = Item::where('slug', $slug)->firstOrFail(); //0
        $interested = Item::where('slug', '!=', $slug)->get()->random(1); //1
        return view('item')->with(['item' => $item, 'interested' => $interested]); //2
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // 0) If no data has been searched for, it will display the existing items. 
    // 1) Displays three items per page.
    // 2) Returns the shop view with a list of all the items. 
    // 3) Looks for an item where the name matches what the user has entered. If some items are found, it will display three per page. 
    // 4) Appends the item with only the search results that were found. 
    // 5) Returns the shop view with a list of items that matches the users search. 
    public function search(Request $req)
    {
        if ($req->search == "") {  //0
            $items = Item::paginate(3); //1
            return view('shop', compact('items')); //2
        }
            else {
                $items = Item::where('name', 'LIKE', '%' . $req->search . '%') -> paginate(3); //3
                $items->appends($req->only('search')); //4
                return view('shop', compact('items')); //5
            }
    }
}