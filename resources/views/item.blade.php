@extends('template')

@section('content')

    <div class="container">
        <p><a href="{{ url('/shop') }}">Shop</a> / {{ $item->name }}</p>
        <h1>{{ $item->name }}</h1>

        <hr>

        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('img/' . $item->image) }}" alt="item" class="img-responsive">
            </div>

            <div class="col-md-8">
                <h3>£{{ $item->price }}</h3>
                <form action="{{ url('/cart') }}" method="POST" class="side-by-side">
                    {!! csrf_field() !!}
                    {{ $item->description }}
                    <br>
                    <br>
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <input type="hidden" name="name" value="{{ $item->name }}">
                    <input type="hidden" name="price" value="{{ $item->price }}">
                    <input type="submit" class="btn btn-success btn-lg" value="Add to Cart">
                </form>

                <form action="{{ url('/wishlist') }}" method="POST" class="side-by-side">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <input type="hidden" name="name" value="{{ $item->name }}">
                    <input type="hidden" name="price" value="{{ $item->price }}">
                    <input type="submit" class="btn btn-primary btn-lg" value="Add to Wishlist">
                </form>

                <br><br>

                
            </div> <!-- end col-md-8 -->
        </div> <!-- end row -->

        <div class="spacer"></div>

        <div class="row">
            <h3>You may also like...</h3>

            @foreach ($interested as $item)
                <div class="col-md-3">
                    <div class="thumbnail">
                        <div class="caption text-center">
                            <a href="{{ url('shop', [$item->slug]) }}"><img src="{{ asset('img/' . $item->image) }}" alt="item" class="img-responsive"></a>
                            <a href="{{ url('shop', [$item->slug]) }}"><h3>{{ $item->name }}</h3>
                            <p>{{ $item->price }}</p>
                            </a>
                        </div> <!-- end caption -->
                    </div> <!-- end thumbnail -->
                </div> <!-- end col-md-3 -->
            @endforeach

        </div> <!-- end row -->

        <div class="spacer"></div>


    </div> <!-- end container -->

@endsection