<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;




class StudentController extends Controller
{
    // List all students
    public function index()
    {
        $students = Student::paginate(10); // 10 per page
        return view('students.index', compact('students'));
    }

    // Show create form
    public function create()
    {
        return view('students.create');
    }

    // Store a new student
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dni' => 'required|string|max:20|unique:students,dni',
            'email' => 'required|email|unique:students,email',
            'birth_date' => 'required|date',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'active' => 'boolean',
        ]);

        // Minimum age validation
        $birthDate = new \DateTime($validated['birth_date']);
        $today = new \DateTime();
        $age = $today->diff($birthDate)->y;
        if ($age < 16) {
            return back()->withErrors(['birth_date' => __('El alumno debe tener al menos 16 años.')])->withInput();
        }

        $student = Student::create($validated);

        return redirect()->route('students.index')->with('success', __('Alumno creado correctamente.'));
    }

    // Show a student
    public function show(Student $student)
    {
        // Returns the Blade view for student details
        return view('students.show', compact('student'));
    }

    // Show edit form
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    // Update a student
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dni' => 'required|string|max:20|unique:students,dni,' . $student->id,
            'email' => 'required|email|unique:students,email,' . $student->id,
            'birth_date' => 'required|date',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'active' => 'boolean',
        ]);

        // Minimum age validation
        if (isset($validated['birth_date'])) {
            $birthDate = new \DateTime($validated['birth_date']);
            $today = new \DateTime();
            $age = $today->diff($birthDate)->y;
            if ($age < 16) {
                return back()->withErrors(['birth_date' => __('El alumno debe tener al menos 16 años.')])->withInput();
            }
        }

        $student->update($validated);

        return redirect()->route('students.index')->with('success', __('Student updated successfully.'));
    }

    // Delete a student
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', __('Student deleted successfully.'));
    }
}
