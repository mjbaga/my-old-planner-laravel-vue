@extends('layout.default')

@section('pageTitle', 'New Project')

@section('content')

	@include('element.header')

	<main class="main">
		<div class="container">
			<?php $title = isset($type) && $type=='authorised-project' ? 'Authorised Projects' : 'Settings' ?>

			@include('element.back', [
				'url' => 'admin.projects', 
				'param' => $type, 
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
				<project-form :type="'{{ $type }}'" :old="{{ json_encode(Session::getOldInput()) }}"></project-form>
			</div>
		</div>
	</main>
	
@endsection 