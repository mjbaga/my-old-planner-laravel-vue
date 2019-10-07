@extends('layout.default')

@section('pageTitle', 'Resources')

@section('content')

	@include('element.header')

	<main class="main">
		<div class="container">
			<div class="fr">
				<a href="{{ route('user.create') }}" class="btn btn__blue">Add New Resource</a>
			</div>
			<resources :errors="{{ $errors }}" :success="'{{ session()->has('success') ? session('success') : '' }}'"></resources>
		</div>
	</main>
@endsection 