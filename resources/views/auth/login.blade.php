@extends('layout.default')

@section('pageTitle', 'Login')

@section('content')
	<login-component :route="'{{ route('login') }}'" :errors="{{ $errors }}"></login-component>
@endsection 
