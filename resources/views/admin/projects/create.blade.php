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

			@php
				if(old('_token')) {
					$old_inputs = [];
					$old_inputs['id'] = 0;
					$old_inputs['engagement_code'] = old('engagement_code');
					$old_inputs['client_name'] = old('client_name');
					$old_inputs['project_name'] = old('project_name');
					$old_inputs['type'] = old('type');
					$old_inputs['status'] = old('status');
					$old_inputs['abbreviation'] = old('abbreviation');
				}
			@endphp

			<div class="col-md-10">
				<project-form :type="'{{ $type }}'" 
					{{ old('_token') !== null ? ':project=' . json_encode($old_inputs, JSON_FORCE_OBJECT) . '' : '' }}>
				</project-form>
			</div>
		</div>
	</main>
	
@endsection 