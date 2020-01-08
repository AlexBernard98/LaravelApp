<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example=navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ route('/shop') }}">Chris's Computer Shop</a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a href="{{ route('index') }}">Home</a></li>
				<li><a href="{{route('/about')}}" class="btn">About</a></li>
				<li><a href="{{route('/contact')}}" class="btn">Contact</a></li>
				<li><a href="{{route('/shop')}}" class="btn">Shop</a></li>

				<li><a href="{{ url ('/wishlist') }}">Wishlist
					({{ Cart::instance('/wishlist')->count(false) }})</a></li>
				<li><a href="{{ url ('/Cart') }}">Cart
					({{ Cart::instance('/cart')->count(false) }})</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<a href="{{action('QuestionController@index')}}" class="btn btn-primary" style="margin-top: 5px;">Ask a Question</a>
			</ul>

			<!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>

		</div>
	</div>
</nav>