<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Cart as Cart;
use Validator;
use App\Order;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // 0) Returns the cart view.
    public function index()
    {
        return view('cart'); //0
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

    // 0) Check to see if item is already in cart by looking for duplicates that match given ID. 
    // 1) If it does exist then return success message and tell the user that it is already in the cart. 
    // 2) If it doesn’t exist then display success message ‘Item added to cart’.
    public function store(Request $request)
    {
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request) { //0
            return $cartItem->id === $request->id;
        });

        if (!$duplicates->isEmpty()) { //1
            return redirect('cart')->withSuccessMessage('Item is already in your cart.');
        }

        Cart::add($request->id, $request->name, 1, $request->price)->associate('App\Item'); //2
        return redirect('cart')->withSuccessMessage('Item was added to your cart.');
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

    // 0) The validator makes a request to make sure the quantity contains data, is numeric, and is between 1 and 10. 
    // 1) If the validation fails, an error message is displayed using session flash and json. 
    // 2) If quantity is valid, updates quantity in cart and then returns message using session flash and json.
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [ //0
            'quantity' => 'required|numeric|between:1,10']);

        if ($validator->fails()) { //1
            session()->flash('error_message', 'Quantity must be between 1 and 10');
            return responce()->json(['success' => false]);
        }

        Cart::update($id, $request->quantity); //2
        session()->flash('success_message', 'Quantity was updated successfully.');
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // 0) Remove item from cart using passed ID and display a success message. 
    public function destroy($id)
    {
        Cart::remove($id); //0
        return redirect('cart')->withSuccessMessage('Item has been removed.');
    }

    // 0) Destroys the contents of the cart and returns success message. 
    public function emptyCart()
    {
        Cart::destroy(); //0
        return redirect('cart')->withSuccessMessage('Your cart has been cleared');
    }

    // 0) Gets the ID of the item in the cart.
    // 1) Removes the item from the cart.
    // 2) Checks to see if the item is already in the wishlist. 
    // 3) If the item is already in the wishlist, display a success message saying 'Item is already in your wishlist.'.
    // 4) If the item is not already in the wishlist, it will be moved and a success message is displayed. 
    public function switchToWishlist($id)
    {
        $item = Cart::get($id); //0

        Cart::remove($id); //1 

        $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($id) { //2
        return $cartItem->id === $id;
    });
        
        if (!$duplicates->isEmpty()) { //3
            return redirect('cart')->withSuccessMessage('Item is already in your wishlist.');
        }

        Cart::instance('wishlist')->add($item->id, $item->name, 1, $item->price)->associate('App\Item'); //4
        return redirect('cart')->withSuccessMessage('Item has been moved to your wishlist.'); 
    }

    // 0) Returns the user to the order view. 
    public function checkout() 
    {
        return view('order'); //0
    }

    // 0) Sends a validation request.
    // 1) Validation is applied to the data.
    // 2) Creates the order.
    // 3) Returns the order view with a success message at the top of the page informing the user that the order has been stored. 
    public function storeorder(Request $request) 
    {
        $order = $this->validate(request(), [ //0
            'orderdate' => 'required', //1
            'firstname' => 'required',
            'surname' => 'required',
            'firstname' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'county' => 'required',
            'postcode' => 'required',
            'ordertotal' => 'required|numeric'
        ]);

        Order::create($order); //2

        return view('payment')->with('success', 'Order details have been stored'); //3
        //return back()->with('success', 'Order details have been stored');
    }
}