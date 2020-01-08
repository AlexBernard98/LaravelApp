<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Cart as Cart;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // 0) Returns the wishlist view.
    public function index()
    {
        return view('wishlist'); //0
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

    // 0) Check to see if item is already in wishlist by looking for duplicates that match given ID. 
    // 1) If it does exist then return success message and tell the user that it is already in the wishlist. 
    // 2) If it doesn’t exist then display success message ‘Item added to wishlist.
    public function store(Request $request)
    {
        $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($request) { //0
            return $cartItem->id === $request->id;
        });

        if (!$duplicates->isEmpty()) { //1
            return redirect('shop')->withSuccessMessage('Item is already in your wishlist.');
        }

        Cart::instance('wishlist')->add($request->id, $request->name, 1, $request->price)->associate('App\Item'); //2
        return redirect('shop')->withSuccessMessage('Item was added to your wishlist.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    // 0) Remove item from wishlist using passed ID and display a success message. 
    public function destroy($id)
    {
        Cart::instance('wishlist')->remove($id); //0
        return redirect('wishlist')->withSuccessMessage('Item has been removed.');
    }

    // 0) Destroys the contents of the wishlist and returns success message. 
    public function emptyWishlist()
    {
        Cart::instance('wishlist')->destroy(); //0
        return redirect('wishlist')->withSuccessMessage('Your wishlist has been cleared');
    }

    // 0) Gets the ID of the item in the wishlist.
    // 1) Removes the item from the cart.
    // 2) Checks to see if the item is already in the cart. 
    // 3) If the item is already in the cart, display a success message saying 'Item is already in your cart.'.
    // 4) If the item is not already in the cart, it will be moved and a success message is displayed. 
     public function switchToCart($id)
    {
        $item = Cart::instance('wishlist')->get($id); //0

        Cart::instance('wishlist')->remove($id); //1

        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($id) { //2
          return $cartItem->id === $id;  
      });
        
        if (!$duplicates->isEmpty()) { //3
            return redirect('cart')->withSuccessMessage('Item is already in your cart.');
        }

        Cart::instance('default')->add($item->id, $item->name, 1, $item->price) //4
                                 ->associate('App\Item');
        return redirect('cart')->withSuccessMessage('Item has been moved to your cart.'); 
    }
}
