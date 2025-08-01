<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'status',
        'modality',
        'virtual_link',
        'max_capacity',
        'teacher_id',
    ];

//     3) Cursos:  
// Campos: 
//  id 
//  titulo 
// No pueden asignarse cursos nuevos a docentes inactivos. 
// Email válido y único. 
// Un docente no puede tener más de 3 cursos activos. 
//  descripción 
//  fecha_inicio 
//  fecha_fin 
//  estado (enum: activo, finalizado, cancelado) 
//  modalidad (enum: presencial, virtual, hibrido) 
//  aula_virtual (nullable, obligatorio si es virtual/hibrido) 
//  cupos_maximos (int, default: 30) 




// Relaciones: - 
// Pertenece a un docente. //  docente_id (FK) 
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
