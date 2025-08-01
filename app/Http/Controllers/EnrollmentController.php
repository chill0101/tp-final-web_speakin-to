<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    // List all enrollments
    public function index()
    {
        if (auth()->user()->role === 'professor') {
            $enrollments = Enrollment::with(['student', 'course'])
                ->whereHas('course', function ($q) {
                    $q->where('teacher_id', auth()->id());
                })->get();
        } else {
            $enrollments = Enrollment::with(['student', 'course'])->get();
        }
        return view('enrollments.index', compact('enrollments'));
    }

    // Show create form
    public function create()
    {
        $students = Student::where('active', true)->get();
        $courses = Course::where('status', 'active')->get();
        return view('enrollments.create', compact('students', 'courses'));
    }

    // Store a new enrollment
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'enrollment_date' => 'required|date',
            'status' => 'required|in:enrolled,in_progress,approved,failed',
            'final_grade' => 'nullable|integer|min:1|max:10',
            'attendance' => 'nullable|integer|min:0|max:100',
            'notes' => 'nullable|string',
            'graded_by_teacher' => 'boolean',
        ]);

        $student = Student::findOrFail($validated['student_id']);
        $course = Course::findOrFail($validated['course_id']);

        // Business rules
        if (!$student->active) {
            return back()->withErrors(['student_id' => __('El alumno está inactivo.')]);
        }
        if ($course->status !== 'active') {
            return back()->withErrors(['course_id' => __('El curso no está activo.')]);
        }
        $enrolledCount = Enrollment::where('course_id', $course->id)->count();
        if ($enrolledCount >= $course->max_capacity) {
            return back()->withErrors(['course_id' => __('El curso ya alcanzó el cupo máximo.')]);
        }
        $activeCourses = Enrollment::where('student_id', $student->id)
            ->whereHas('course', function($q) {
                $q->where('status', 'active');
            })->count();
        if ($activeCourses >= 5) {
            return back()->withErrors(['student_id' => __('El alumno ya tiene 5 cursos activos.')]);
        }
        if (Enrollment::where('student_id', $student->id)->where('course_id', $course->id)->exists()) {
            return back()->withErrors(['student_id' => __('El alumno ya está inscripto en este curso.')]);
        }
        // Validate final grade only if graded by teacher
          if (!empty($validated['final_grade'])) {
            if (empty($validated['graded_by_teacher']) || !$validated['graded_by_teacher']) {
                return back()->withErrors(['final_grade' => __('Solo se puede asignar nota si fue evaluado por el docente.')]);
            }
            if ($validated['final_grade'] < 1 || $validated['final_grade'] > 10) {
                return back()->withErrors(['final_grade' => __('La nota debe estar entre 1 y 10.')]);
            }
        }

        // Validate attendance for approval
        if (isset($validated['status']) && $validated['status'] === 'approved') {
            if (empty($validated['attendance']) || $validated['attendance'] < 75) {
                return back()->withErrors(['attendance' => __('No se puede aprobar alumnos con menos del 75% de asistencia.')]);
            }
        }

        Enrollment::create($validated);

        return redirect()->route('enrollments.index')->with('success', __('Inscripción registrada correctamente.'));
    }

    // Show an enrollment
    public function show(Enrollment $enrollment)
    {
        return view('enrollments.show', compact('enrollment'));
    }

    // Show edit form
    public function edit(Enrollment $enrollment)
    {
        $students = Student::where('active', true)->get();
        $courses = Course::where('status', 'active')->get();
        return view('enrollments.edit', compact('enrollment', 'students', 'courses'));
    }

    // Update an enrollment (implement as needed)
    public function update(Request $request, Enrollment $enrollment)
    {
        // Implement update logic if needed
    }

    // Delete an enrollment
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('enrollments.index')->with('success', __('Inscripción eliminada correctamente.'));
    }
}
