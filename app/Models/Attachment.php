<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'course_id',
        'title',
        'file_url',
        'type',
        'uploaded_at',
    ];

// Campos: 
//  id 

//  titulo 
//  archivo_url 
//  tipo (enum: tarea, material, guía) 
//  fecha_subida 

    public function course() //  curso_id (FK)
    {
        return $this->belongsTo(Course::class);
    }
}
