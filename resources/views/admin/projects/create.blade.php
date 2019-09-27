@extends('layout.default')

@section('pageTitle', 'New Project')

@section('content')

	@include('element.header')

	<main class="main">
		<div class="container">
			@include('element.sidenav')

			<div class="col-md-10">
				@if(isset($type) && $type=='authorised-project')
					<auth-project-form></auth-project-form>
				@else
					<project-form></project-form>
				@endif
			</div>
		</div>
	</main>
	
@endsection 