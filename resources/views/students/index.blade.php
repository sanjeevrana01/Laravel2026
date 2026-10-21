```blade
@extends('layouts.app')

@section('title', 'Students')
@section('breadcrumb', 'Students')

@section('content')
<div class="page-heading">
    <div>
        <div class="eyebrow">DIRECTORY</div>
        <h1>Students <span class="heading-count">{{ $students->total() }}</span></h1>
        <p class="page-subtitle">Manage student records in one place.</p>
    </div>
    <a class="btn btn-primary" href="{{ route('students.create') }}"><span class="btn-plus">＋</span> Add student</a>
</div>

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="panel directory-panel">
    <form class="toolbar" method="GET" action="{{ route('students.index') }}">
        <div class="search-box">
            <span>⌕</span>
            <input type="search" name="search" value="{{ $search }}"
                placeholder="Search by name or email..."
                aria-label="Search students">
            <button type="submit">Search</button>
        </div>

        @if ($search !== '')
        <a class="clear-link" href="{{ route('students.index') }}">Clear search</a>
        @endif

        <div class="sort-control">
            <label for="sort">Sort by</label>
            <select id="sort" name="sort" onchange="this.form.submit()">
                <option value="name" {{ $sort === 'name' ? 'selected' : '' }}>Name (A–Z)</option>
                <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>Newest first</option>
            </select>
        </div>

        <a href="{{ route('students.export', ['search' => $search, 'sort' => $sort]) }}"
            class="button">Export CSV</a>

        <div class="toolbar-count">
            {{ $students->total() }} {{ \Illuminate\Support\Str::plural('student', $students->total()) }}
        </div>
    </form>

    @if ($students->isEmpty())
    <div class="empty-state">
        <div class="empty-illustration">⌕</div>
        <h3>{{ $search ? 'No matching students' : 'No students yet' }}</h3>
        <p>{{ $search ? 'Try another name or email address.' : 'Add a student to populate your directory.' }}</p>

        @if ($search)
        <a class="btn btn-secondary" href="{{ route('students.index') }}">Clear search</a>
        @else
        <a class="btn btn-primary" href="{{ route('students.create') }}">＋ Add student</a>
        @endif
    </div>
    @else
    <form method="POST"
        action="{{ route('students.bulk-delete') }}"
        onsubmit="return confirm('Are you sure you want to delete the selected students?');">
        @csrf
        @method('DELETE')

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="select-all" aria-label="Select all students">
                        </th>
                        <th>STUDENT</th>
                        <th>EMAIL ADDRESS</th>
                        <th>COURSE</th>
                        <th>AGE</th>
                        <th>CREATED</th>
                        <th class="right-align">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                    <tr>
                        <td>
                            <input type="checkbox"
                                name="students[]"
                                value="{{ $student->id }}">
                        </td>
                        <td>
                            <div class="student-cell">
                                <div class="avatar {{ ['avatar-purple','avatar-blue','avatar-orange','avatar-green'][$student->id % 4] }}">{{ strtoupper(substr($student->name, 0, 1)) }}</div>
                                <strong>{{ $student->name }}</strong>
                            </div>
                        </td>
                        <td class="muted-cell">{{ $student->email }}</td>
                        <td class="muted-cell">
                            {{ $student->course?->name ?? 'Not assigned' }}
                        </td>
                        <td>{{ $student->age ? $student->age . ' yrs' : '—' }}</td>
                        <td class="muted-cell">{{ $student->created_at?->format('d M Y') }}</td>
                        <td>
                            <div class="action-group">
                                <a class="action-edit" href="{{ route('students.edit', $student->id) }}">Edit</a>

                                <button type="button"
                                    class="action-delete"
                                    onclick="if (confirm('Delete this student? This cannot be undone.')) { document.getElementById('delete-student-{{ $student->id }}').submit(); }">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <button type="submit" class="btn btn-primary" id="bulk-delete-button">
            Delete Selected
        </button>
    </form>

    @foreach ($students as $student)
    <form id="delete-student-{{ $student->id }}"
        method="POST"
        action="{{ route('students.destroy', $student->id) }}"
        style="display: none;">
        @csrf
        @method('DELETE')
    </form>
    @endforeach

    <div class="pagination-wrap">{{ $students->links() }}</div>
    @endif
</div>
<script>
    document.getElementById('select-all')?.addEventListener('change', function() {
        document.querySelectorAll('input[name="students[]"]').forEach(function(checkbox) {
            checkbox.checked = document.getElementById('select-all').checked;
        });
    });
    const bulkDeleteButton = document.getElementById('bulk-delete-button');
    const studentCheckboxes = document.querySelectorAll('input[name="students[]"]');

    function updateBulkDeleteButton() {
        bulkDeleteButton.disabled = !Array.from(studentCheckboxes).some(
            checkbox => checkbox.checked
        );
    }

    studentCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkDeleteButton);
    });

    updateBulkDeleteButton();
</script>
@endsection