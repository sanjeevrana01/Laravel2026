@extends('layouts.app')

@section('title', 'Edit student')
@section('breadcrumb', 'Students / Edit')

@section('content')
<div class="page-heading">
    <div>
        <div class="eyebrow">STUDENT DIRECTORY</div>
        <h1>Edit student</h1>
        <p class="page-subtitle">Update the details for {{ $student->name }}.</p>
    </div>
    <a class="btn btn-secondary" href="{{ route('students.index') }}">← Back to students</a>
</div>
<div class="form-layout">
    <div class="panel form-panel">
        <div class="form-panel-heading">
            <div class="avatar avatar-purple large-avatar">{{ strtoupper(substr($student->name, 0, 1)) }}</div>
            <div>
                <h2>{{ $student->name }}</h2>
                <p>Student ID #{{ $student->id }}</p>
            </div>
        </div>
        <form method="POST" action="{{ route('students.update', $student->id) }}" class="student-form">
            @csrf
            @method('PUT')
            <div class="form-field"><label for="name">Full name <span>*</span></label><input id="name" name="name" value="{{ old('name', $student->name) }}" required maxlength="255" autofocus>@error('name')<small class="field-error">{{ $message }}</small>@enderror</div>
            <div class="form-field"><label for="email">Email address <span>*</span></label><input id="email" type="email" name="email" value="{{ old('email', $student->email) }}" required maxlength="255">@error('email')<small class="field-error">{{ $message }}</small>@enderror</div>
            <div class="form-field"><label for="age">Age <small>(optional)</small></label><input id="age" type="number" name="age" value="{{ old('age', $student->age) }}" min="1" max="120">@error('age')<small class="field-error">{{ $message }}</small>@enderror</div>
            <div class="form-group form-field">
                <label for="course_id">Course</label>

                <select name="course_id" id="course_id" class="form-control">
                    <option value="">No course selected</option>

                    @foreach ($courses as $course)
                    <option value="{{ $course->id }}"
                        {{ old('course_id', $student->course_id) == $course->id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-actions"><a class="btn btn-secondary" href="{{ route('students.index') }}">Cancel</a><button class="btn btn-primary" type="submit">Save changes <span>→</span></button></div>

        </form>
    </div>
    <aside class="form-aside">
        <div class="aside-art">✎</div>
        <h3>Editing a record</h3>
        <p>Changes are validated before being saved. A student's existing email address can remain unchanged.</p>
        <div class="aside-rule"></div>
        <div class="aside-meta"><span>Created</span><strong>{{ $student->created_at?->format('d M Y, H:i') }}</strong></div>
        <div class="aside-meta"><span>Last updated</span><strong>{{ $student->updated_at?->format('d M Y, H:i') }}</strong></div>
    </aside>
</div>
@endsection