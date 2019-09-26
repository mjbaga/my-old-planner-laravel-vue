@extends('layout.default')

@section('pageTitle', 'Login')

@section('content')
	<login-component 
		:route="'{{ route('login') }}'" 
		:errors="{{ $errors }}" 
		:success="'{{ session()->has('success') ? session('success') : '' }}'"
		:logo="'{{ asset('images/fibonacci.png') }}'"
	>
	</login-component>
@endsection 
