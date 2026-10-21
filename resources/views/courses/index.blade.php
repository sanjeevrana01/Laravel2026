```blade
@extends('layouts.app')

@section('title', 'Courses')
@section('breadcrumb', 'Courses')

@section('content')
<div class="page-heading">

    <div>
        <div class="eyebrow">DIRECTORY</div>
        <h1>Courses <span class="heading-count">{{ $courses->count() }}</span></h1>
        <p class="page-subtitle">Manage your available courses.</p>
    </div>
    <a href="{{ route('courses.create') }}" class="btn btn-primary">
        + Add Course
    </a>
</div>

<div class="panel directory-panel">
    @if ($courses->isEmpty())
    <div class="empty-state">
        <h3>No courses yet</h3>
        <p>Add your first course to get started.</p>
    </div>
    @else
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>COURSE</th>
                    <th>DESCRIPTION</th>
                    <th>STUDENTS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                <tr>
                    <td><strong>{{ $course->name }}</strong></td>
                    <td class="muted-cell">
                        {{ $course->description ?: '—' }}
                    </td>
                    <td>{{ $course->students()->count() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection