@extends('layout.default')

@section('pageTitle', 'Resources')

@section('content')

	@include('element.header')

	<main class="main">
		<div class="container">
			<div class="fr">
				<a href="{{ route('user.create') }}" class="btn btn__blue">Add New Resource</a>
			</div>
			@if(session()->has('success'))
				<div class="alert alert-success" role="alert">
					{{ session('success') }}
				</div>
			@elseif(session()->has('error'))
				<div class="alert alert-danger" role="alert">
					{{ session('error') }}
				</div>
			@endif
			<resources></resources>
		</div>
	</main>
@endsection 