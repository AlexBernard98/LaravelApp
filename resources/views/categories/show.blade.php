@extends('template')

@section('content')
<div class="container">
	<h1>{{$category['id']}}</h1></br>
	<p class="lead">{{$category['name']}}</p>
	<p>{{$category['description']}}</p>
</div>
</hr>
@endsection