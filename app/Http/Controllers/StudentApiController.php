<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentApiController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Student::orderBy('id')->paginate(20));
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(Student::findOrFail($id));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:students,email'],
            'age' => ['nullable', 'integer', 'min:1', 'max:120'],
        ]);

        $student = Student::create($validated);

        return response()->json($student, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'email', 'max:255', 'unique:students,email,' . $student->id],
            'age' => ['sometimes', 'nullable', 'integer', 'min:1', 'max:120'],
        ]);

        $student->update($validated);

        return response()->json($student);
    }

    public function destroy(int $id): JsonResponse
    {
        Student::findOrFail($id)->delete();

        return response()->json(['message' => 'Student deleted successfully.']);
    }
}
