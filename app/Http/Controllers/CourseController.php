<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // List all courses
    public function index()
    {
        if (auth()->user()->role === 'professor') {
            $courses = Course::where('teacher_id', auth()->id())->get();
        } else {
            $courses = Course::all();
        }
        return view('courses.index', compact('courses'));
    }

    // Show create form
    public function create()
    {
        // Check permissions: only admin and coordinator can create courses
        $teachers = \App\Models\User::where('role', 'professor')->get();
        return view('courses.create', compact('teachers'));
    }

    // Store a new course
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:active,finished,cancelled',
            'modality' => 'required|in:on_site,virtual,hybrid',
            'virtual_link' => 'nullable|string|max:255',
            'max_capacity' => 'required|integer|min:1',
            'teacher_id' => 'required|exists:users,id',
        ], [
            'title.required' => 'El título es obligatorio.',
            'start_date.required' => 'La fecha de inicio es obligatoria.',
            'end_date.required' => 'La fecha de fin es obligatoria.',
            'end_date.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la de inicio.',
            'status.required' => 'El estado es obligatorio.',
            'modality.required' => 'La modalidad es obligatoria.',
            'max_capacity.required' => 'El cupo máximo es obligatorio.',
            'teacher_id.required' => 'Debes seleccionar un docente.',
            'teacher_id.exists' => 'El docente seleccionado no existe.',
        ]);

            // Check if the user is a professor 
        $teacher = \App\Models\User::find($validated['teacher_id']);
        if (!$teacher || $teacher->role !== 'professor') {
            return back()->withErrors(['teacher_id' => 'Solo puedes asignar usuarios con rol docente.'])->withInput();
        }

        // Validate that the teacher does not have more than 3 active courses
        $activeCourses = Course::where('teacher_id', $teacher->id)->where('status', 'active')->count();
        if ($activeCourses >= 3) {
            return back()->withErrors(['teacher_id' => 'El docente ya tiene 3 cursos activos.'])->withInput();
        }

        // Conditional validation for virtual_link
        if (in_array($validated['modality'], ['virtual', 'hybrid']) && empty($validated['virtual_link'])) {
            return back()->withErrors(['virtual_link' => 'El enlace virtual es obligatorio para modalidad virtual o híbrida.'])->withInput();
        }

        $course = Course::create($validated);

        return redirect()->route('courses.index')->with('success', 'Curso creado correctamente.');
    }

    // Show a course
    public function show(Course $course)
    {
        // Returns the Blade view for course details
        return view('courses.show', compact('course'));
    }

    // Show edit form
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    // Update a course
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:active,finished,cancelled',
            'modality' => 'required|in:on_site,virtual,hybrid',
            'virtual_link' => 'nullable|string|max:255',
            'max_capacity' => 'required|integer|min:1',
            'teacher_id' => 'required|exists:users,id',
        ], [
            'title.required' => 'El título es obligatorio.',
            'start_date.required' => 'La fecha de inicio es obligatoria.',
            'end_date.required' => 'La fecha de fin es obligatoria.',
            'end_date.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la de inicio.',
            'status.required' => 'El estado es obligatorio.',
            'modality.required' => 'La modalidad es obligatoria.',
            'max_capacity.required' => 'El cupo máximo es obligatorio.',
            'teacher_id.required' => 'Debes seleccionar un docente.',
            'teacher_id.exists' => 'El docente seleccionado no existe.',
        ]);

        // Validate that the selected user is a professor
        $teacher = \App\Models\User::find($validated['teacher_id']);
        if (!$teacher || $teacher->role !== 'professor') {
            return back()->withErrors(['teacher_id' => 'Solo puedes asignar usuarios con rol docente.'])->withInput();
        }

        if (in_array($validated['modality'], ['virtual', 'hybrid']) && empty($validated['virtual_link'])) {
            return back()->withErrors(['virtual_link' => 'El enlace virtual es obligatorio para modalidad virtual o híbrida.'])->withInput();
        }

        // If trying to finish the course, validate that it has students
        if ($validated['status'] === 'finished') {
            $enrolledCount = \App\Models\Enrollment::where('course_id', $course->id)->count();
            if ($enrolledCount === 0) {
                return back()->withErrors(['status' => 'No puedes finalizar un curso sin alumnos inscriptos.'])->withInput();
            }
        }

        $course->update($validated);

        return redirect()->route('courses.index')->with('success', 'Curso actualizado correctamente.');
    }

    // Delete a course
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Curso eliminado correctamente.');
    }
}
