@extends('layouts.app')

@section('title', 'Students')
@section('breadcrumb', 'Students')

@section('content')
<div class="page-heading">
    <div><div class="eyebrow">DIRECTORY</div><h1>Students <span class="heading-count">{{ $students->total() }}</span></h1><p class="page-subtitle">Manage student records in one place.</p></div>
    <a class="btn btn-primary" href="{{ route('students.create') }}"><span class="btn-plus">＋</span> Add student</a>
</div>

<div class="panel directory-panel">
    <form class="toolbar" method="GET" action="{{ route('students.index') }}">
        <div class="search-box"><span>⌕</span><input type="search" name="search" value="{{ $search }}" placeholder="Search by name or email..." aria-label="Search students"><button type="submit">Search</button></div>
        @if ($search !== '')<a class="clear-link" href="{{ route('students.index') }}">Clear search</a>@endif
        <div class="toolbar-count">{{ $students->total() }} {{ \Illuminate\Support\Str::plural('student', $students->total()) }}</div>
    </form>
    @if ($students->isEmpty())
        <div class="empty-state">
            <div class="empty-illustration">⌕</div>
            <h3>{{ $search ? 'No matching students' : 'No students yet' }}</h3>
            <p>{{ $search ? 'Try another name or email address.' : 'Add a student to populate your directory.' }}</p>
            @if ($search)<a class="btn btn-secondary" href="{{ route('students.index') }}">Clear search</a>@else<a class="btn btn-primary" href="{{ route('students.create') }}">＋ Add student</a>@endif
        </div>
    @else
        <div class="table-wrap">
            <table>
                <thead><tr><th>STUDENT</th><th>EMAIL ADDRESS</th><th>AGE</th><th>CREATED</th><th class="right-align">ACTIONS</th></tr></thead>
                <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td><div class="student-cell"><div class="avatar {{ ['avatar-purple','avatar-blue','avatar-orange','avatar-green'][$student->id % 4] }}">{{ strtoupper(substr($student->name, 0, 1)) }}</div><strong>{{ $student->name }}</strong></div></td>
                        <td class="muted-cell">{{ $student->email }}</td>
                        <td>{{ $student->age ? $student->age . ' yrs' : '—' }}</td>
                        <td class="muted-cell">{{ $student->created_at?->format('d M Y') }}</td>
                        <td><div class="action-group"><a class="action-edit" href="{{ route('students.edit', $student->id) }}">Edit</a><form method="POST" action="{{ route('students.destroy', $student->id) }}" onsubmit="return confirm('Delete {{ addslashes($student->name) }}? This cannot be undone.')">@csrf @method('DELETE')<button class="action-delete" type="submit">Delete</button></form></div></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination-wrap">{{ $students->links() }}</div>
    @endif
</div>
@endsection
