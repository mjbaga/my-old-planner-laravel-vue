@extends('layout.default')

@section('pageTitle', 'Add New Title')

@section('content')

	@include('element.header')

	@include('element.back', ['url' => '/settings', 'section' => 'Settings'])

@endsection 