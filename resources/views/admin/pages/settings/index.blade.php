@extends('layout.default')

@section('pageTitle', 'Settings / Engagements')

@section('content')

	@include('element.header')

	<main class="main">
		<div class="container">
			@include('element.sidenav')
			<div class="fr">
				<a href="{{ route('project.create') }}" class="btn btn__blue">Add Engagement</a>
			</div>
			<project-list :errors="{{ $errors }}" :success="'{{ session()->has('success') ? session('success') : '' }}'">
			</project-list>
		</div>
	</main>
@endsection 