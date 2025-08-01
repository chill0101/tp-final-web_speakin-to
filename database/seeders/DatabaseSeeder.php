<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Student;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Evaluation;
use App\Models\Attachment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database. 
     * This method creates an admin user, several professors, coordinators, students, courses, enrollments, evaluations, and attachments.
     * 
     */
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'AllmightyAdmin',
            'email' => 'admin@speakin.to',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        // Professors
        $teacher1 = User::create([
            'name' => 'Dewey Finn',
            'email' => 'dewey@speakin.to',
            'password' => Hash::make('teacher'),
            'role' => 'professor',
        ]);
        $teacher2 = User::create([
            'name' => 'Minerva McGonagall',
            'email' => 'minerva@speakin.to',
            'password' => Hash::make('professor'),
            'role' => 'professor',
        ]);

        // Coordinators
        User::create([
            'name' => 'Corgi the Coordinator',
            'email' => 'coordinator@speakin.to',
            'password' => Hash::make('coordinator'),
            'role' => 'coordinator',
        ]);
        User::create([
            'name' => 'Morpheus',
            'email' => 'morpheus@speakin.to',
            'password' => Hash::make('coordinator'),
            'role' => 'coordinator',
        ]);

        // Students
        $students1 = Student::factory()->count(5)->create();
        $students2 = Student::factory()->count(3)->create();

        // Spetial case to show limit of 5 active courses
        $limitStudent = Student::factory()->create(['email' => 'limit@student.com', 'dni' => '77777777']);

        // Courses
        $course1 = Course::create([
            'title' => 'English Level 1',
            'description' => 'Basic English course for disociative minds',
            'start_date' => now()->addDays(7),
            'end_date' => now()->addMonths(3),
            'status' => 'active',
            'modality' => 'on_site',
            'max_capacity' => 20,
            'teacher_id' => $teacher1->id,
        ]);

        $course2 = Course::create([
            'title' => 'Español de supervivencia',
            'description' => 'Español con dialecto del salvaje Oeste',
            'start_date' => now()->addDays(14),
            'end_date' => now()->addMonths(4),
            'status' => 'active',
            'modality' => 'virtual',
            'virtual_link' => 'https://meet.example.com/spanish',
            'max_capacity' => 15,
            'teacher_id' => $teacher1->id,
        ]);

        $course3 = Course::create([
            'title' => 'Hablar con animales',
            'description' => 'Curso avanzado de traducción de sonidos animales',
            'start_date' => now()->addDays(21),
            'end_date' => now()->addMonths(2),
            'status' => 'active',
            'modality' => 'hybrid',
            'virtual_link' => 'https://meet.example.com/animals',
            'max_capacity' => 10,
            'teacher_id' => $teacher2->id,
        ]);

        // 5 extra courses for limit student
        $extraCourses = [];
        for ($i = 1; $i <= 5; $i++) {
            $extraCourses[$i] = Course::create([
                'title' => "Curso Extra $i",
                'description' => "Curso extra para prueba $i",
                'start_date' => now()->addDays($i),
                'end_date' => now()->addMonths(2),
                'status' => 'active',
                'modality' => 'on_site',
                'max_capacity' => 10,
                'teacher_id' => $teacher1->id,
            ]);
        }

        // Enrollments and Evaluations for testourse1
        foreach ($students1 as $student) {
            Enrollment::create([
                'student_id' => $student->id,
                'course_id' => $course1->id,
                'enrollment_date' => now(),
                'status' => 'enrolled',
                'final_grade' => rand(6, 10),
                'attendance' => rand(80, 100),
                'notes' => 'Good performance',
                'graded_by_teacher' => true,
            ]);

            Evaluation::create([
                'student_id' => $student->id,
                'course_id' => $course1->id,
                'score' => rand(6, 10),
                'comments' => '5 pal peso',
            ]);
        }

        // Enrollments and Evaluations for course3
        foreach ($students2 as $student) {
            Enrollment::create([
                'student_id' => $student->id,
                'course_id' => $course3->id,
                'enrollment_date' => now(),
                'status' => 'enrolled',
                'final_grade' => rand(7, 10),
                'attendance' => rand(85, 100),
                'notes' => 'Performance',
                'graded_by_teacher' => true,
            ]);

            Evaluation::create([
                'student_id' => $student->id,
                'course_id' => $course3->id,
                'score' => rand(7, 10),
                'comments' => 'Sigue practicando, tu esfuerzo compensa tu falta de talento!',
            ]);
        }

        // Set up enrollments and evaluations for limit student -- 5 active courses is a lot so it's easier for the reveiw
        foreach ($extraCourses as $course) {
            Enrollment::create([
                'student_id' => $limitStudent->id,
                'course_id' => $course->id,
                'enrollment_date' => now(),
                'status' => 'enrolled',
                'final_grade' => rand(6, 10),
                'attendance' => rand(80, 100),
                'notes' => 'Prueba',
                'graded_by_teacher' => true,
            ]);
        }


    }
}