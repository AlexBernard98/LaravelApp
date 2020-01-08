@extends('template')
@section('content')
   <body>
     <form action="payment" method="POST">
     {{ csrf_field() }}
         <script
	    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        	    data-key="{{ env('STRIPE_PUB_KEY') }}"
             data-amount="1999"
            data-name="Stripe Demo"
            data-description="Chris Computer Shop Payment"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto"
            data-currency="gbp">
         </script>
     </form>
@endsection