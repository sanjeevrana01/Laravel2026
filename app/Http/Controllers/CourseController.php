<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CourseController extends Controller
{
    public function index(): View
    {
        $courses = Course::orderBy('name')->get();

        return view('courses.index', compact('courses'));
    }

    public function create(): View
    {
        return view('courses.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:courses,name'],
            'description' => ['nullable', 'string'],
        ]);

        Course::create($validated);

        return redirect()->route('courses.index')
            ->with('success', 'Course added successfully.');
    }
}
