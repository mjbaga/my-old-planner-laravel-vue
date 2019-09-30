@extends('layout.default')

@section('pageTitle', 'Login')

@section('content')
	{{ isset($messages) ? dd($messages) : '' }}
	<login-component 
		:route="'{{ route('login') }}'" 
		:errors="{{ isset($messages) ? json_encode($messages) : json_encode([]) }}"
		:logo="'{{ asset('images/fibonacci.png') }}'"
	>
	</login-component>
@endsection 
