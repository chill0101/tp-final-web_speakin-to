<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    // List all evaluations
    public function index()
    {
        if (auth()->user()->role === 'professor') {
            $evaluations = Evaluation::with(['student', 'course'])
                ->whereHas('course', function ($q) {
                    $q->where('teacher_id', auth()->id());
                })->get();
        } else {
            $evaluations = Evaluation::with(['student', 'course'])->get();
        }
        return view('evaluations.index', compact('evaluations'));
    }

    // Show create form
    public function create()
    {
        $students = Student::all();
        $courses = Course::all();
        return view('evaluations.create', compact('students', 'courses'));
    }

    // Store a new evaluation
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'score' => 'nullable|integer|min:1|max:10',
            'comments' => 'nullable|string',
        ]);

        Evaluation::create($validated);

        return redirect()->route('evaluations.index')->with('success', __('Evaluación registrada correctamente.'));
    }

    // Show an evaluation
    public function show(Evaluation $evaluation)
    {
        return view('evaluations.show', compact('evaluation'));
    }

    // Show edit form
    public function edit(Evaluation $evaluation)
    {
        $students = Student::all();
        $courses = Course::all();
        return view('evaluations.edit', compact('evaluation', 'students', 'courses'));
    }

    // Update an evaluation
    public function update(Request $request, Evaluation $evaluation)
    {
        $validated = $request->validate([
            'score' => 'nullable|integer|min:1|max:10',
            'comments' => 'nullable|string',
        ]);

        $evaluation->update($validated);

        return redirect()->route('evaluations.index')->with('success', __('Evaluación actualizada correctamente.'));
    }

    // Delete an evaluation
    public function destroy(Evaluation $evaluation)
    {
        $evaluation->delete();
        return redirect()->route('evaluations.index')->with('success', __('Evaluación eliminada correctamente.'));
    }
}
