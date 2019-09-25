@extends('layout.default')

@section('pageTitle', 'Resource Board')

@section('content')

	@include('element.header')

	<a href="{{ route('logout') }}"> Logout</a>
	<h1>Resource Board</h1>
@endsection 