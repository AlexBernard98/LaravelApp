<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>eCommerce Shop</title>
        <!-- Fonts -->
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">


   <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Store CSRF token for AJAX calls -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Favicon and Apple Icons 
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">  -->

    <style>

        .spacer {
            margin-bottom: 100px;
        }

        .cart-image {
            width: 100px;
        }

        footer {
            background-color: #f5f5f5;
            padding: 20px 0;
        }

        .table>tbody>tr>td {
            vertical-align: middle;
        }

        .side-by-side {
            display: inline-block;
        }
    </style>
</head>
        
    <body> 
        <header>

        <nav class="navbar navbar-default navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="{{ url('/') }}">eCommerce Shop</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
           
                <li class="{{ Request::segment(1) === 'shop' ? 'active' : null }} }}"><a href="{{ url('/shop') }}">Shop</a></li>
                <li class="{{ Request::segment(1) === 'contact' ? 'active' : null }} }}"><a href="{{ url('/contact') }}">Contact</a></li>
                <li class="{{ Request::segment(1) === 'wishlist' ? 'active' : null }} }}"><a href="{{ url('/wishlist') }}">Wishlist
                    ({{ Cart::instance('wishlist')->count(false) }})</a></li>
                 <li class="{{ Request::segment(1) === 'cart' ? 'active' : null }} }}"><a href="{{ url('/cart') }}">Cart 
                    ({{ Cart::instance('default')->count(false) }})</a></li>
                    
              </ul>

            <!-- Right Side Of Navbar -->

            <ul class="nav navbar-nav navbar-right">

             <!-- Authentication Links -->
             @guest
                <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
            @else                   
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        @if ( Auth::user()->is_admin()) 
                                <li><a href="{{ url('/items') }}">Admin Items</a></li> 
                        @endif 
                        <li>
                            <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                            </form>
                        </li>  
                        
                                
                    </ul>                         
            @endif
                    
                    

            </div><!--/.nav-collapse -->
          </div>
        </nav>

    </header>   
     <!-- include('_includes/nav/topnav') -->
      @yield('content')

 <!--<footer>
      <div class="container">
       
      </div>
    </footer> -->

<!-- JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

@yield('extra-js')

</body>
</html>