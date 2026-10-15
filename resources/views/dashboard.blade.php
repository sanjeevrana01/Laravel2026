@extends('layouts.app')

@section('title', 'Overview')
@section('breadcrumb', 'Overview')

@section('content')
<div class="page-heading">
    <div>
        <div class="eyebrow">MONDAY, YOUR WORKSPACE</div>
        <h1>Good to see you <span class="wave">✦</span></h1>
        <p class="page-subtitle">Here’s what’s happening with your students today.</p>
    </div>
    <a class="btn btn-primary" href="{{ route('students.create') }}"><span class="btn-plus">＋</span> Add student</a>
</div>

<div class="stats-grid">
    <article class="stat-card">
        <div class="stat-top"><span class="stat-label">Total students</span><span class="stat-icon icon-violet">♙</span></div>
        <div class="stat-number">{{ number_format($studentCount) }}</div>
        <div class="stat-foot"><span class="mini-pill pill-violet">All records</span><span class="stat-note">in your database</span></div>
    </article>
    <article class="stat-card">
        <div class="stat-top"><span class="stat-label">Average age</span><span class="stat-icon icon-blue">◷</span></div>
        <div class="stat-number">{{ $studentCount ? $averageAge : '—' }}<span class="stat-unit">{{ $studentCount ? ' yrs' : '' }}</span></div>
        <div class="stat-foot"><span class="mini-pill pill-blue">Age insights</span><span class="stat-note">based on entered ages</span></div>
    </article>
    <article class="stat-card">
        <div class="stat-top"><span class="stat-label">Data health</span><span class="stat-icon icon-green">✓</span></div>
        <div class="stat-number">Ready</div>
        <div class="stat-foot"><span class="health-dot"></span><span class="stat-note">Database connected</span></div>
    </article>
</div>

<div class="section-heading">
    <div><h2>Recently added</h2><p>Your latest student records</p></div>
    <a class="text-link" href="{{ route('students.index') }}">View all students <span>→</span></a>
</div>

<div class="panel table-panel">
    @if ($recentStudents->isEmpty())
        <div class="empty-state">
            <div class="empty-illustration">♙</div>
            <h3>Your student list is waiting</h3>
            <p>Add your first student to start exploring the dashboard.</p>
            <a class="btn btn-primary" href="{{ route('students.create') }}">＋ Add your first student</a>
        </div>
    @else
        <div class="table-wrap">
            <table>
                <thead><tr><th>STUDENT</th><th>EMAIL ADDRESS</th><th>AGE</th><th>ADDED</th><th></th></tr></thead>
                <tbody>
                @foreach ($recentStudents as $student)
                    <tr>
                        <td><div class="student-cell"><div class="avatar {{ ['avatar-purple','avatar-blue','avatar-orange','avatar-green'][$student->id % 4] }}">{{ strtoupper(substr($student->name, 0, 1)) }}</div><strong>{{ $student->name }}</strong></div></td>
                        <td class="muted-cell">{{ $student->email }}</td>
                        <td>{{ $student->age ? $student->age . ' yrs' : '—' }}</td>
                        <td class="muted-cell">{{ $student->created_at?->format('d M Y') }}</td>
                        <td><a class="icon-action" href="{{ route('students.edit', $student->id) }}" aria-label="Edit student">↗</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="panel-footer"><span>Showing {{ $recentStudents->count() }} recent records</span><a href="{{ route('students.index') }}">Manage students →</a></div>
    @endif
</div>

<div class="tip-banner"><div class="tip-symbol">✦</div><div><strong>Make it yours</strong><p>Try searching records, editing a student, or testing the JSON API with curl.</p></div><a href="{{ route('students.index') }}">Explore records <span>→</span></a></div>
@endsection
