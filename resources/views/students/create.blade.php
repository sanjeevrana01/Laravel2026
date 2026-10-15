@extends('layouts.app')

@section('title', 'Add student')
@section('breadcrumb', 'Students / Add')

@section('content')
<div class="page-heading">
    <div><div class="eyebrow">STUDENT DIRECTORY</div><h1>Add a student</h1><p class="page-subtitle">Enter the details below to create a new record.</p></div>
    <a class="btn btn-secondary" href="{{ route('students.index') }}">← Back to students</a>
</div>
<div class="form-layout">
    <div class="panel form-panel">
        <div class="form-panel-heading"><div class="form-heading-icon">＋</div><div><h2>Student details</h2><p>Fields marked with * are required.</p></div></div>
        <form method="POST" action="{{ route('students.store') }}" class="student-form">
            @csrf
            <div class="form-field"><label for="name">Full name <span>*</span></label><input id="name" name="name" value="{{ old('name') }}" placeholder="e.g. Alice Brown" required maxlength="255" autofocus>@error('name')<small class="field-error">{{ $message }}</small>@enderror</div>
            <div class="form-field"><label for="email">Email address <span>*</span></label><input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="alice@example.com" required maxlength="255">@error('email')<small class="field-error">{{ $message }}</small>@enderror</div>
            <div class="form-field"><label for="age">Age <small>(optional)</small></label><input id="age" type="number" name="age" value="{{ old('age') }}" placeholder="e.g. 22" min="1" max="120">@error('age')<small class="field-error">{{ $message }}</small>@enderror<div class="field-hint">Enter a value between 1 and 120.</div></div>
            <div class="form-actions"><a class="btn btn-secondary" href="{{ route('students.index') }}">Cancel</a><button class="btn btn-primary" type="submit">Create student <span>→</span></button></div>
        </form>
    </div>
    <aside class="form-aside"><div class="aside-art">✦</div><h3>Keep your directory tidy</h3><p>Use a valid email address for each student. Email addresses must be unique in this directory.</p><div class="aside-rule"></div><div class="aside-check">✓ <span>Validated on submission</span></div><div class="aside-check">✓ <span>Saved to your database</span></div></aside>
</div>
@endsection
