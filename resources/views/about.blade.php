@extends('layouts.app')
@section('title', 'About')
@section('breadcrumb', 'About')
@section('content')
<div class="page-heading"><div><div class="eyebrow">ABOUT THIS PROJECT</div><h1>About StudentDesk</h1><p class="page-subtitle">A hands-on Laravel learning application.</p></div></div>
<div class="panel about-panel"><h2>Built to learn by doing</h2><p>StudentDesk demonstrates Laravel routes, controllers, Eloquent models, validation, Blade templates, pagination, and JSON API endpoints.</p><a class="btn btn-primary" href="{{ route('students.index') }}">Open student directory →</a></div>
@endsection
