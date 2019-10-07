@extends('layout.default')

@section('pageTitle', 'Settings / Engagements')

@section('content')

	@include('element.header')

	<main class="main">
		<div class="container">
			@include('element.sidenav')
			<div class="fr">
				<a href="{{ route('project.create', $type) }}" class="btn btn__blue">
					Add {{ $type == 'authorised-project' ? 'Authorised Project' : 'Engagement' }}
				</a>
			</div>
			<project-list :type="'{{ $type }}'">
			</project-list>
		</div>
	</main>
@endsection 