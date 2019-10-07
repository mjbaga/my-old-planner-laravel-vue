@extends('layout.default')

@section('pageTitle', 'Edit User/Resource')

@section('content')

	@include('element.header')

	<main class="main">
		<div class="container">
			@include('element.back', ['url' => 'admin.resources', 'title' => 'Resources', 'param' => ''])
			<div class="col-md-10">
				<h2>Edit user</h2>
				@if(session()->has('success'))
					<div class="alert alert-success" role="alert">
						{{ session('success') }}
					</div>
				@elseif(session()->has('error'))
					<div class="alert alert-danger" role="alert">
						{{ session('error') }}
					</div>
				@endif
				<user-form :titles="{{ json_encode($titles) }}" :user="{{ json_encode($user) }}" :submiturl="'/user/{{ $user->id }}'"></user-form>
			</div>
		</div>
	</main>
	
@endsection 