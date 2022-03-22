@extends('layout.default')

@section('pageTitle', 'Resource Board')

@section('content')

	@include('element.header')

	<main class="main">
		<div class="container">
			<resource-board :titles="{{ $titles }}"></resource-board>
		</div>
	</main>
@endsection 