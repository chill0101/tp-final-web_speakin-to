<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
        'score',
        'comments',
    ];
// 6) Evaluaciones:  
// Campos: 
//  id 
//  alumno_id (FK) 
//  curso_id (FK) 
//  descripcion 
//  nota 
//  fecha // date was not included

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
