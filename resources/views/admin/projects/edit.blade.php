@extends('layout.default')

@section('pageTitle', 'Edit Project')

@section('content')

	@include('element.header')

	<main class="main">
		<div class="container">
			<div class="col-md-10">
				@if(isset($project))
					@if($project->type == 'authorised-project')
						<auth-project-form :project="{{ json_encode($project) }}"></auth-project-form>
					@else
						<project-form :project="{{ json_encode($project) }}"></project-form>
					@endif
				@endif
			</div>
		</div>
	</main>
	
@endsection 