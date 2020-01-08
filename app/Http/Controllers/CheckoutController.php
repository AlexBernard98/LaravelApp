<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

class CheckoutController extends Controller
{

    // 0) Sets the API key to our developer account. 
    // 1) Creates the customer account based on the account that I created on Stripe. 
    // 2) Creates a charge and charges the customer account that has just been made. 
    // 3) If the charhe is successful, display a message.
    // 4) Catches any errors and displays an approriate error message. 
    public function charge(Request $request)
    {
        try {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY')); //0
        $customer = Customer::create(array( //1
            'email' => $request->stripeEmail,
            'source'  => $request->stripeToken
        ));

        $charge = Charge::create(array( //2
            'customer' => $customer->id,
            'amount'   => 1999,
            'currency' => 'gbp'
        ));

          return 'Charge successful'; //3
		} catch (\Exception $ex) { //4
    		return $ex->getMessage(); 
		}
    }
}