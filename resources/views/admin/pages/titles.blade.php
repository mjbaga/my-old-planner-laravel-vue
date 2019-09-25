@extends('layout.default')

@section('pageTitle', 'Settings')

@section('content')

	@include('element.header')

	<main class="main">
		<div class="container">
				@include('element.sidenav')

			<title-list :errors="{{ $errors }}" :success="'{{ session()->has('success') ? session('success') : '' }}'"></title-list>
		</div>
	</main>
@endsection 