@extends('layout.default')

@section('pageTitle', 'Settings / Authorised Projects')

@section('content')

	@include('element.header')

	<main class="main">
		<div class="container">
			@include('element.sidenav')
			<div class="fr">
				<a href="{{ route('authproject.create') }}" class="btn btn__blue">Add Authorised Project</a>
			</div>
			<auth-project-list :errors="{{ $errors }}" :success="'{{ session()->has('success') ? session('success') : '' }}'">
			</auth-project-list>
		</div>
	</main>
@endsection 