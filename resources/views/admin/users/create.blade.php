@extends('layout.default')

@section('pageTitle', 'New User/Resource')

@section('content')

	@include('element.header')

	<main class="main">
		<div class="container">
			@include('element.back', ['url' => 'admin.resources', 'title' => 'Resources', 'param' => ''])
			<div class="col-md-10">
				<user-form :titles="{{ json_encode($titles) }}"></user-form>
			</div>
		</div>
	</main>
	
@endsection 