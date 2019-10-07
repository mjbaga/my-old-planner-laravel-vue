@extends('layout.default')

@section('pageTitle', 'New User/Resource')

@section('content')

	@include('element.header')

	<main class="main">
		<div class="container">
			@include('element.back', ['url' => 'admin.resources', 'title' => 'Resources', 'param' => ''])

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
					$old_inputs['first_name'] = old('first_name');
					$old_inputs['last_name'] = old('last_name');
					$old_inputs['email'] = old('email');
					$old_inputs['image'] = '';
					$old_inputs['title_id'] = old('title_id');
				}
			@endphp

			<div class="col-md-10">
				<user-form :titles="{{ json_encode($titles) }}" 
					{{ old('_token') !== null ? ':user=' . json_encode($old_inputs, JSON_FORCE_OBJECT) . '' : '' }}>
				</user-form>
			</div>
		</div>
	</main>
	
@endsection 