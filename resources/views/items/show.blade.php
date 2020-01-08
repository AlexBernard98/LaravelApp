@extends('template')

@section('content')
<div class="container">
	<h1>{{$item['id']}}</h1></br>
	<p class="lead">{{$item['name']}}</p>
	<p>Price: £{{$item['price']}}</p>
</div>
</hr>
@endsection