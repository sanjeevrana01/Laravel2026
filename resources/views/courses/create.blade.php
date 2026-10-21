```blade
@extends('layouts.app')

@section('title', 'Add Course')
@section('breadcrumb', 'Courses / Add Course')

@section('content')
<div class="page-heading">
    <div>
        <div class="eyebrow">COURSE MANAGEMENT</div>
        <h1>Add Course</h1>
        <p class="page-subtitle">Create a course and make it available to your students.</p>
    </div>

    <a href="{{ route('courses.index') }}" class="btn btn-secondary">
        ← Back to Courses
    </a>
</div>

<div class="course-form-layout">
    <div class="panel course-form-panel">
        <div class="form-panel-heading">
            <div class="form-icon">📚</div>
            <div>
                <h2>Course details</h2>
                <p>Enter the information for this course below.</p>
            </div>
        </div>

        <form method="POST" action="{{ route('courses.store') }}">
            @csrf

            <div class="form-group">
                <label for="name">Course name <span>*</span></label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-control"
                    value="{{ old('name') }}"
                    placeholder="e.g. Laravel Development"
                    maxlength="255"
                    required>
                @error('name')
                <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description <small>(Optional)</small></label>
                <textarea
                    id="description"
                    name="description"
                    class="form-control course-description"
                    rows="5"
                    placeholder="Describe the course, topics covered, and learning objectives...">{{ old('description') }}</textarea>
                @error('description')
                <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('courses.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    Save Course
                </button>
            </div>
        </form>
    </div>

    <aside class="course-tip-panel">
        <div class="course-tip-icon">✦</div>
        <h3>Creating a great course</h3>
        <p>Use a clear, descriptive name so students and administrators can easily identify the course.</p>
        <div class="course-tip-divider"></div>
        <div class="course-tip-item">
            <span>01</span>
            <div>
                <strong>Keep it clear</strong>
                <p>Choose a name that describes the subject.</p>
            </div>
        </div>
        <div class="course-tip-item">
            <span>02</span>
            <div>
                <strong>Add details</strong>
                <p>A short description helps explain what the course covers.</p>
            </div>
        </div>
    </aside>
</div>
@endsection
```