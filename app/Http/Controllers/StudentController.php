<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function dashboard(): View
    {
        return view('dashboard', [
            'studentCount' => Student::count(),
            'recentStudents' => Student::latest()->take(5)->get(),
            'averageAge' => round((float) (Student::whereNotNull('age')->avg('age') ?? 0), 1),
        ]);
    }


    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $sort = $request->query('sort', 'name');

        $students = Student::with('course')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($sort === 'newest', function ($query) {
                $query->orderByDesc('created_at');
            }, function ($query) {
                $query->orderBy('name');
            })
            ->paginate(10)
            ->withQueryString();

        return view('students.index', compact('students', 'search', 'sort'));
    }


    public function export(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $students = Student::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($request->query('sort') === 'newest', function ($query) {
                $query->orderByDesc('created_at');
            }, function ($query) {
                $query->orderBy('name');
            })
            ->cursor();

        return response()->streamDownload(function () use ($students) {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['ID', 'Name', 'Email', 'Age', 'Created At']);
            $safeCsvValue = function ($value) {
                $value = (string) ($value ?? '');

                if (preg_match('/^[\s]*[=+\-@]/', $value)) {
                    return "'" . $value;
                }

                return $value;
            };
            foreach ($students as $student) {
                fputcsv($file, [
                    $student->id,
                    $safeCsvValue($student->name),
                    $safeCsvValue($student->email),
                    $student->age,
                    $student->created_at?->toDateTimeString(),
                ]);
            }

            fclose($file);
        }, 'students.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }



    public function create(): View
    {
        $courses = \App\Models\Course::orderBy('name')->get();

        return view('students.create', compact('courses'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:students,email'],
            'age' => ['nullable', 'integer', 'min:1', 'max:120'],
            'course_id' => ['nullable', 'exists:courses,id'],
        ]);

        Student::create($validated);

        return redirect()->route('students.index')
            ->with('success', 'Student added successfully.');
    }

    public function edit(int $id): View
    {
        $student = Student::findOrFail($id);

        $courses = \App\Models\Course::orderBy('name')->get();

        return view('students.edit', compact('student', 'courses'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:students,email,' . $student->id],
            'age' => ['nullable', 'integer', 'min:1', 'max:120'],
            'course_id' => ['nullable', 'exists:courses,id'],
        ]);

        $student->update($validated);

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        Student::findOrFail($id)->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $validated = $request->validate([
            'students' => ['required', 'array', 'min:1'],
            'students.*' => ['required', 'integer', 'exists:students,id'],
        ]);

        Student::whereIn('id', $validated['students'])->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Selected students deleted successfully.');
    }
}
