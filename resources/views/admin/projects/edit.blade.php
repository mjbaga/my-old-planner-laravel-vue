@extends('layout.default')

@section('pageTitle', 'Edit Project')

@section('content')

	@include('element.header')

	<main class="main">
		<div class="container">
			<?php $title = isset($project->type) && $project->type=='authorised-project' ? 'Authorised Projects' : 'Settings' ?>

			@include('element.back', [
				'url' => 'admin.projects', 
				'param' => $project->type, 
				'title' => $title
			])

			@if($errors->any())
				<div class="message">
					<div class="alert alert-error" role="alert">
						@foreach($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</div>
				</div>
			@endif

			<div class="col-md-10">
				@if(isset($project))
					<project-form :project="{{ json_encode($project) }}" :type="'{{ $project->type }}'" :submiturl="'/project/edit/{{ $project->engagement_code }}'">
					</project-form>
				@endif
			</div>
		</div>
	</main>
	
@endsection 