<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
        'enrollment_date',
        'status',
        'final_grade',
        'attendance',
        'notes',
        'graded_by_teacher',
    ];


// 4) Inscripciones:  
// Campos: 
//  id 
//  alumno_id (FK) 
//  curso_id (FK) 
//  fecha_inscripción 
//  estado (enum: activo, aprobado, desaprobado) 
//  nota_final (nullable) 
//  asistencias (entero) 
//  Observaciones (nullable) 
//  evaluado_por_docente (boolean, default: false) 

// Relaciones: - - 
// Un alumno puede inscribirse a muchos cursos. 
// Un curso puede tener muchos alumnos.
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
